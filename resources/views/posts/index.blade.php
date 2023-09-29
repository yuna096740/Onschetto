@section('title', 'スケジュール')

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Schedule') }}
    </h2>
  </x-slot>
  <div class="container mx-auto w-3/5">
  
    <div class="flex justify-end my-5">
      
      <div class="flex">
        <button id="clearButton" style="display: none;" class="mt-3 text-white text-sm">リセットする</button>
        
        <input type="text" id="searchSchedule" placeholder="イベントを検索する" class="w-60 mx-3 rounded border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50">
        <input type="date" id="searchDate">
        
        <button id="searchButton" class="rounded bg-violet-700 border text-white hover:bg-violet-500 ml-3 px-5 py-2">検索</button>
      </div>
    </div>
    
    <x-clickScheduleModal>
      <x-editScheduleModal>
        <div id="calendar" ></div>
      </x-editScheduleModal>
    </x-clickScheduleModal>
    
  </div>
</x-app-layout>

<!-- micromodal -->
<script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
<script>
    MicroModal.init({
    disableScroll: true,
    awaitOpenAnimation: true,
    awaitCloseAnimation: true
  });
</script>
