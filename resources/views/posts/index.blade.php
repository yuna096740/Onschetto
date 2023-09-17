@extends('layouts/app')
@section('title', 'スケジュール')
@include('posts.createScheduleModal')
@include('posts.clickScheduleModal')
@include('posts.editScheduleModal')

@section('content')
<div class="container mx-auto">

  <div class="flex justify-between mt-2">
    
    <div>
      <button class="rounded bg-gray-500 text-white hover:bg-gray-700 px-5 py-2" data-micromodal-trigger="createScheduleModal">新規作成</button>
    </div>
    
    <form>
      <button id="clearButton" style="display: none;" class="mt-3 text-gray-500">リセットする</button>
      
      <input type="text" id="searchSchedule" placeholder="イベントを検索する" class="w-60 mx-3 rounded border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50">
      <input type="date" id="searchDate">
      
      <button id="searchButton" class="rounded bg-gray-500 text-white hover:bg-gray-700 ml-3 px-5 py-2">検索</button>
    </form>
  </div>
  
  <div id="calendar" ></div>
  
</div>

<script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
<script>
    MicroModal.init({
    disableScroll: true,
    awaitOpenAnimation: true,
    awaitCloseAnimation: true
  });
</script>

@endsection