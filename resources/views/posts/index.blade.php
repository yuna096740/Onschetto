@extends('layouts/app')
@section('title', 'スケジュール')
@include('posts.createScheduleModal')
@include('posts.clickScheduleModal')
@include('posts.editScheduleModal')

@section('content')

<input type="text" id="searchSchedule" placeholder="検索する" class="w-1/3 ml-3 my-5 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50">
<button id="searchButton" class="rounded bg-gray-500 text-white hover:bg-gray-700 px-4 py-2">検索</button>

<div id="calendar"></div>

<script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
<script>
  MicroModal.init({
    disableScroll: true,
    awaitOpenAnimation: true,
    awaitCloseAnimation: true
  });
</script>

@endsection