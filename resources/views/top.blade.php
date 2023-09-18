@section('title', 'Onschetto')

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Onschetto') }}
    </h2>
  </x-slot>

  <div class="w-1/2 h-full bg-white shadow-lg rounded-lg p-5 dark:bg-slate-100 mx-auto my-5">
    <div class="flex items-center gap-x-4 mb-3">
      <div class="inline-flex justify-center items-center w-[100px] h-[100px] rounded">
        <img src="{{ asset('img/onschettoLogo.svg') }}" alt="">
      </div>
      <div class="flex-shrink-0">
        <h3 class="block text-lg font-semibold text-gray-800 dark:text-black">Onschetto(オン助っ人)</h3>
        <p class="text-gray-600 dark:text-gray-400">スケジュールをオンスケで行いましょう</p>
      </div>
    </div>
  </div>

</x-app-layout>