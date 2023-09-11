@extends('layouts/app')
@section('title', '')

@section('content')
  {{-- <form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <label for="task">Task</label>
    <input type="task" name="task">

    <label for="details">Details</label>
    <input type="details" name="details">

    <label for="schedule">Schedule</label>
    <input type="schedule" name="schedule">

    <button type="submit">Submit</button>
  </form> --}}

  <div id="calendar"></div>
@endsection