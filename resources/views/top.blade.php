@section('title', 'ONschetto')

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('ONschetto') }}
    </h2>
  </x-slot>

  <div class="relative overflow-hidden md:my-10 lg:my-20">
    <div class="mx-auto max-w-screen-md py-22 px-4 sm:px-6 md:max-w-screen-xl md:py-20 lg:py-60 md:px-8">
      <div class="md:pr-8 md:w-1/2 xl:pr-0 xl:w-5/12">
        <h1 class="text-3xl text-gray-800 font-bold md:text-4xl md:leading-tight lg:text-5xl lg:leading-tight dark:text-gray-200">
          <span class="text-blue-600 dark:text-violet-500">ONschetto</span> で予定を オンスケでこなす
        </h1>
        <p class="mt-3 text-base text-gray-500">
          ONschettoはシンプルなデザインとクールなレイアウトのスケジュール管理アプリです。簡単に予定を追加、編集ができる為スケジュール管理の助っ人となります。数日にまたぐ予定も可視化されているので管理が楽になります。
        </p>
  
        <div class="mt-8 grid">
          <button type="button" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm sm:p-4 dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">ONschettoを使ってみる</a>
          </button>
        </div>

        <div class="py-6 flex items-center text-gray-400 uppercase before:flex-[1_1_0%] before:border-t before:mr-6 after:flex-[1_1_0%] after:border-t after:ml-6 dark:text-gray-500 dark:before:border-gray-600 dark:after:border-gray-600">既に登録済みですか?</div>

        <div class="mt-8 grid">
          <button type="button" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm sm:p-4 dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">ログイン画面へ</a>
          </button>
        </div>
  
      </div>
    </div>
  
    <div class="hidden md:block md:absolute md:top-0 md:left-1/2 md:right-0">
      <img src="{{ asset('img/onschettoTopLogo.svg') }}" class="md:h-screen">
    </div>
  </div>
  <div class="my-50"></div>

</x-app-layout>