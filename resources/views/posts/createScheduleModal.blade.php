<body>
  <div class="modal micromodal-slide" id="createScheduleModal" aria-hidden="true">
      <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="createScheduleModal-title">
          <header class="modal__header">
            <h2 class="modal__title" id="createScheduleModal-title">
              スケジュール作成(create)
            </h2>
            <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
          </header>
          <form name="createSchedule" method="POST" action='/schedule-add'>
            <main class="modal__content" id="createScheduleModal-content">

              @csrf

              <div class="input-form my-2">
                <label for="createEventName">予定</label><br>
                <input type="title" id="createEventName" name="createEventName" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="予定を入力">
              </div>

              <div class="input-form my-2">
                <label for="createDetail">詳細</label><br>
                <textarea type="text" id="createDetail" name="createDetail" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="詳細を入力"></textarea>
              </div>
              
              <div class="flex">
                <div class="input-form my-2">
                  <label for="CreateStartDate">開始日</label><br>
                  <input type="date" id="createStartDate" name="createStartDate">
                </div>
  
                <div class="input-form my-2 mx-2">
                  <label for="createEndDate">終了日</label><br>
                  <input type="date" id="createEndDate" name="createEndDate">
                </div>
              </div>

              <div class="input-form my-2 mx-2">
                <label for="createScheduleColor">予定色</label>
                <input type="color" id="createScheduleColor" name="createScheduleColor">
              </div>

            </main>

            <footer class="modal__footer">
              <button class="modal__btn modal__btn-primary" id="SbmitSchedule" type="submit">登録</button>
              <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">閉じる</button>
            </footer>
          </form>
        </div>
      </div>
  </div>
 </body>