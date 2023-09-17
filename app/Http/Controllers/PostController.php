<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Models\Post;

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
    public function scheduleAdd(Request $request)
    {

        // 多重送信対策
        $request->session()->regenerateToken();

        // 保存処理
        // validation
        $request->validate([
            'startDate'     => 'required|date',
            'endDate'       => 'required|date',
            'eventName'     => 'required|max:32',
            'scheduleColor' => 'required|string',
        ]);

        // 日付をUnixタイムスタンプに変換
        $startDate = \Carbon\Carbon::parse($request->input('startDate'))->timestamp;
        $endDate = \Carbon\Carbon::parse($request->input('endDate'))->timestamp;

        // 登録処理
        $userId = Auth::id();
        $post = new Post;

        $post->user_id = $userId;
        $post->startDate = date('Y-m-d', $startDate);
        $post->endDate = date('Y-m-d', $endDate);
        $post->eventName = $request->input('eventName');
        $post->scheduleColor = $request->input('scheduleColor');
        
        $post->save();

        return view("/posts/index");
  
    }

    /**
     * イベントを取得
     * 
     * @param Request $request
     */
    public function scheduleGet(Request $request)
    {
        $userId = Auth::id();
        
        // validation
        $request->validate([
            'startDate' => 'required|integer',
            'endDate' => 'required|integer'
        ]);

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
    public function scheduleEdit(Request $request) 
    {
        // validation
        $request->validate([
            'id'            => 'required|integer',
            'startDate'     => 'required|date',
            'endDate'       => 'required|date',
            'eventName'     => 'required|max:32',
            'scheduleColor' => 'required|string',
        ]);

        // 編集処理
        $eventId = $request->input('id');
        $post = Post::find($eventId);

        if ($post) {
            // データが存在する場合の処理
            $post->startDate = $request->input('startDate');
            $post->endDate = $request->input('endDate');
            $post->eventName = $request->input('eventName');
            $post->scheduleColor = $request->input('scheduleColor');
            
            $post->save();
            return redirect()->route('posts.index');
        } else {
            throw new \Exception('データが見つかりません');
        }
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
            return response()->json(['success' => false, 'message' => '削除対象のデータが見つかりません']);
        }

        // データが存在する場合は削除処理を続行
        $post->delete();

        return redirect()->route('posts.index');
    }
}