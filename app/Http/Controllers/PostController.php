<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request) 
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
        // validation
        $request->validate([
            'start_date' => 'required|integer',
            'end_date'   => 'required|integer',
            'event_name' => 'required|max:32',
        ]);

        // 登録処理
        $userId = Auth::id();
        $post = new Post;
        // 日付に変換。JavaScriptのタイムスタンプはミリ秒なので秒に変換
        $post->user_id = $userId;
        $post->start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $post->end_date =   date('Y-m-d', $request->input('end_date') / 1000);
        $post->event_name = $request->input('event_name');
        $post->save();

        return;
    }

    /**
     * イベントを取得
     * 
     * @param Request $request
     */
    public function scheduleGet(Request $request)
    {
        // validation
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer'
        ]);

        // カレンダー表示期間
        $start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);

        // 登録処理
        return Post::query()
            ->select(
                // FullCalendarの形式に合わせる
                'start_date as start',
                'end_date as end',
                'event_name as title'
            )
            // FullCalendarの表示範囲のみ表示
            ->where('end_date', '>', $start_date)
            ->where('start_date', '<', $end_date)
            ->get();
    }
}
