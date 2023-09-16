@extends('layouts/app')
@section('title', 'スケジュール')
{{-- @include('posts.createScheduleModal') --}}
@include('posts.clickScheduleModal')
@include('posts.editScheduleModal')

@section('content')

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