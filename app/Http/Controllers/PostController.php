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

        // 保存処理
        // validation
        $request->validate([
            'startDate'     => 'required|date',
            'endDate'       => 'required|date',
            'eventName'     => 'required|max:32',
            'detail'        => 'required|max:80',
            'scheduleColor' => 'required|string',
        ]);

        $startDate = \Carbon\Carbon::parse($request->input('startDate'))->timestamp;
        $endDate = \Carbon\Carbon::parse($request->input('endDate'))->timestamp;

        // 登録処理
        $userId = Auth::id();
        $post = new Post;
        // 日付に変換。JavaScriptのタイムスタンプはミリ秒なので秒に変換
        $post->user_id = $userId;
        $post->startDate = date('Y-m-d', $startDate);
        $post->endDate = date('Y-m-d', $endDate);
        $post->eventName = $request->input('eventName');
        $post->detail = $request->input('detail');
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
                'startDate as start',
                'endDate as end',
                'eventName as title'
            )
            // FullCalendarの表示範囲のみ表示
            ->where('endDate', '>', $startDate)
            ->where('startDate', '<', $endDate)
            ->get();
    }
}
