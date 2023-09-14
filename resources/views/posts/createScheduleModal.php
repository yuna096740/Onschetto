

<body>
  <div class="modal micromodal-slide" id="modal-2" aria-hidden="true">
      <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
          <header class="modal__header">
            <h2 class="modal__title" id="modal-2-title">
              スケジュール作成
            </h2>
            <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
          </header>
          <form name="createSchedule" method="POST" action='/schedule-add'>
            <main class="modal__content" id="modal-2-content">

              @csrf

              <div class="input-form my-2">
                <label for="eventName">予定</label><br>
                <input type="title" id="eventName" name="eventName" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="予定を入力">
              </div>

              <div class="input-form my-2">
                <label for="detail">詳細</label><br>
                <textarea type="text" id="detail" name="detail" class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-indigo-500 placeholder-gray-500 placeholder-opacity-50" placeholder="詳細を入力"></textarea>
              </div>
              
              <div class="flex">
                <div class="input-form my-2">
                  <label for="startDate">開始日</label><br>
                  <input type="date" id="startDate" name="startDate">
                </div>
  
                <div class="input-form my-2 mx-2">
                  <label for="endDate">終了日</label><br>
                  <input type="date" id="endDate" name="endDate">
                </div>
              </div>

              <div class="input-form my-2 mx-2">
                <label for="color">予定色</label>
                <input type="color" id="scheduleColor" name="scheduleColor">
              </div>

            </main>

            <footer class="modal__footer">
              <button class="modal__btn modal__btn-primary" id="submitSchedule" type="submit">登録</button>
              <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">閉じる</button>
            </footer>
          </form>
        </div>
      </div>
  </div>
  
  <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
  <script>
    MicroModal.init();
  </script>
 </body>