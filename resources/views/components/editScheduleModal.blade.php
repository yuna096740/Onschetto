<body>
  <div class="modal micromodal-slide" id="editScheduleModal" aria-hidden="true">
      <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="editScheduleModal-title">
          <header class="modal__header">
            <h2 class="text-violet-700 text-2xl" id="editScheduleModal-title">
              スケジュール編集
            </h2>
            <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
          </header>
          <form name="editSchedule" method="POST" action="{{ route('schedule-edit') }}">
            <main class="modal__content" id="editScheduleModal-content">

            @csrf
            
            <input type="hidden" id="id" value="" name="id">

            <div class="input-form my-2">
              <label for="createEventName">予定</label><br>
              <input type="title" id="editEventName"  name="eventName" value="" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-violet-500 placeholder-gray-500 placeholder-opacity-50" placeholder="予定を入力">
            </div>

            <div class="flex">
              <div class="input-form my-2">
                <label for="CreateStartDate">開始日</label><br>
                <input type="date" id="editStartDate" name="startDate" value="">
              </div>

              <div class="input-form my-2 mx-2">
                <label for="createEndDate">終了日</label><br>
                <input type="date" id="editEndDate" name="endDate" value="">
              </div>
            </div>

            <div class="input-form my-2 mx-2">
              <label for="createScheduleColor">予定色</label>
              <input type="color" id="editScheduleColor" name="scheduleColor" value="">
            </div>

          </main>

          <footer class="modal__footer flex justify-between">
            <button id="editSbmitSchedule" class="text-sm bg-violet-600 rounded text-white hover:bg-violet-900 py-2 px-4" type="submit">更新する</button>
            <button data-micromodal-close aria-label="Close this dialog window" class="text-sm bg-gray-500 rounded text-white hover:bg-gray-700 py-2 px-4">閉じる</button>
          </footer>
        </form>

        <form id="deleteSchedule" action="{{ route('schedule-delete') }}" method="POST">
          @csrf
          <input type="hidden" name="id">
          
          <button id="submitDeleteSchedule" class="mt-3 text-sm bg-red-600 rounded text-white hover:bg-red-700 py-2 px-4" type="submit">削除する</button>
        </form>
      </div>
    </div>
  </div>
 </body>
 {{ $slot }}