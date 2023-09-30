<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use DateTime;

class PostController extends Controller
{
    public function __constract()
    {
        // ユーザーとしてログイン済みかどうか
        $this->middleware('auth:users');
    }

    public function index() 
    {
        return view('posts.index');
    }

    /**
     * イベントを登録
     * 
     * @param Request $request
     */
    public function scheduleAdd(PostRequest $request)
    {
        // 多重送信対策
        $request->session()->regenerateToken();

        // 日付をUnixタイムスタンプに変換
        $startDate = \Carbon\Carbon::parse($request->input('startDate'))->timestamp;
        $endDate = \Carbon\Carbon::parse($request->input('endDate'))->timestamp;

        // 登録処理
        $userId = Auth::id();
        $post = new Post;

        // startDate & endDateが正しく入力されているか
        if ($request->input('startDate') === $request->input('endDate')) {
            return redirect()->route('posts.index')->with('flashError', '日付を正しく入力してください');
        }

        $post->user_id = $userId;
        $post->startDate = date('Y-m-d', $startDate);
        $post->endDate = date('Y-m-d', $endDate);
        $post->eventName = $request->input('eventName');
        $post->scheduleColor = $request->input('scheduleColor');
        $post->description = $request->input('description');
        
        $post->save();
        return redirect()->route('posts.index')->with('flashSuccess', 'イベントを追加しました');
    }

    /**
     * イベントを取得
     * 
     * @param Request $request
     */
    public function scheduleGet(Request $request)
    {
        $userId = Auth::id();

        // カレンダー表示期間
        $startDate = date('Y-m-d', $request->input('startDate') / 1000);
        $endDate = date('Y-m-d', $request->input('endDate') / 1000);

        // 登録処理
        return Post::query()
            ->select(
                // FullCalendarの形式に合わせる
                'id as id',
                'startDate as start',
                'endDate as end',
                'eventName as title',
                'scheduleColor as color',
                'description as description',
            )
            // FullCalendarの表示範囲のみ表示
            ->where('user_id', $userId)
            ->where('endDate', '>', $startDate)
            ->where('startDate', '<', $endDate)
            ->get();
    }

    /**
     * イベントを編集
     * 
     * @param Request $request
     */
    public function scheduleEdit(PostRequest $request) 
    {
        // 編集処理
        $eventId = $request->input('id');
        $post = Post::find($eventId);

        // startDate & endDateが正しく入力されているか
        if ($request->input('startDate') === $request->input('endDate')) {
            return redirect()->route('posts.index')->with('flashError', '日付を正しく入力してください');
        }

        // データが存在する場合の処理
        $post->startDate = $request->input('startDate');
        $post->endDate = $request->input('endDate');
        $post->eventName = $request->input('eventName');
        $post->scheduleColor = $request->input('scheduleColor');
        $post->description = $request->input('description');

        
        $post->save();
        return redirect()->route('posts.index')->with('flashSuccess', '変更しました');
    }

    /**
     * ドロップイベントを編集
     * 
     * @param Request $request
     */
    public function scheduleDrop(PostRequest $request)
    {
        $post = Post::find($request->id);
        $post->startDate = $request->startDate;
        $post->endDate = $request->endDate;
        $post->save();
    }

    /**
     * リサイズイベントを編集
     * 
     * @param Request $request
     */
    public function scheduleResize(PostRequest $request)
    {
        $post = Post::find($request->id);
        $post->startDate = $request->startDate;
        $post->endDate = $request->endDate;
        $post->save();
    }

    /**
     * イベントを削除
     * 
     * @param Request $request
     */
    public function scheduleDelete(Request $request) 
    {
        $postId = $request->input('id');
        $post = Post::find($postId);

        if (!$post) {
            return redirect()->route('posts.index')->with('flashError', '削除に失敗しました');
        }

        // データが存在する場合は削除処理を続行
        $post->delete();

        return redirect()->route('posts.index')->with('flashSuccess', '予定を削除しました');
    }
}