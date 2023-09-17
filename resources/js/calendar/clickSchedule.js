import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
// 非同期通信を行うためのaxiosを追加
import axios from 'axios';

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById("calendar");

  if (calendarEl) {
    let calendar = new Calendar(calendarEl, {
      plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
      initialView: "dayGridMonth", // ポインタをクリックして日付の上にドラッグできる
      dayMaxEvents: true, // イベント多の場合「詳細」リンクを許可する
      selectable: true, // 日付クリックで日付モード
      navLinks: true,
      editable: true,
      droppable: true,
      headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
      },
      // 日本語化
      locale: "ja",
    
      // 登録機能
      dateClick: function (info) {
        // クリックされた日付を取得
        const createStartDate = formatDate(info.date);
        const createEndDate = formatDate(info.date);

        // "YYYY-MM-DD" 形式の文字列に変換
        function formatDate(date) {
          const year = date.getFullYear();
          const month = String(date.getMonth() + 1).padStart(2, '0');
          const day = String(date.getDate()).padStart(2, '0');
          return `${year}-${month}-${day}`;
        }

        // 初期値をセット(date)
        document.getElementById('startDate').value = createStartDate;
        document.getElementById('endDate').value = createEndDate;
        MicroModal.show('clickScheduleModal');

        const submitSchedule = document.getElementById('submitSchedule');
        submitSchedule.addEventListener('click', buttonClick);

        function buttonClick() {
          // Laravelの登録処理の呼び出し
          const data = {
            startDate: info.start.valueOf(),
            endDate: info.end.valueOf(),
            eventName: info.title,
            scheduleColor: info.color,
          };

          axios
            .post("/schedule-add", data)
            .then(() => {
                // イベントの追加
                calendar.addEvent({
                    title: eventName,
                    start: startDate,
                    end: endDate,
                    allDay: true,
                });
            })
            .catch(() => {
                // バリデーションエラーetc
                alert("登録に失敗しました");
            });
          };
      },
  
      // Laravelのイベント取得処理の呼び出し
      events: function (info, successCallback, failureCallback) {
        axios
          .post("/schedule-get", {
            eventId : info.id,
            startDate: info.start.valueOf(),
            endDate: info.end.valueOf(),
          })
          .then((response) => {
            calendar.removeAllEvents(); // 追加したイベントを削除
            successCallback(response.data); // カレンダーに読み込み
          })
          .catch((error) => {
            // バリデーションエラーetc
            console.error("Error", error);
            alert("登録に失敗しました");
          });
  
      },

      // 編集機能 & 削除機能
      eventClick: function(info) {
        const eventId = info.event.id;
        const editEventName = info.event.title;
        const editScheduleColor = info.event.backgroundColor;
        const editStartDate = formatDate(info.event.start);
        const editEndDate = formatDate(info.event.end);

        // "YYYY-MM-DD" 形式の文字列に変換
        function formatDate(date) {
          const year = date.getFullYear();
          const month = String(date.getMonth() + 1).padStart(2, '0');
          const day = String(date.getDate()).padStart(2, '0');
          return `${year}-${month}-${day}`;
        }
        
        document.getElementById("id").value = eventId;
        document.getElementById("editEventName").value = editEventName;
        document.getElementById("editStartDate").value = editStartDate;
        document.getElementById("editEndDate").value = editEndDate;
        document.getElementById("editScheduleColor").value = editScheduleColor;
        MicroModal.show('editScheduleModal');


        // 削除ボタンを押下
        const submitDeleteSchedule = document.getElementById("submitDeleteSchedule");
        submitDeleteSchedule.addEventListener('click', buttonClick);

        function buttonClick() {
          const confirmDelete = confirm("本当に削除しますか？");

          if (confirmDelete) {
            var form = document.getElementById("deleteSchedule");
            form.elements['id'].value = eventId;
            form.submit();
          }
        };
      },
    });

    calendar.render();
    
    // 検索機能
    document.getElementById("searchButton").addEventListener("click", function () {
      // 文字列内のすべての文字に対して小文字変換(日本語は変換されない)
      const searchText = document.getElementById("searchSchedule").value.toLowerCase(); 
    
      // イベントを取得
      const events = calendar.getEvents();
    
      // カレンダー上のすべてのイベントを非表示にする
      events.forEach(function (event) {
        event.remove();
      });
    
      // 検索条件に一致するイベントだけをカレンダーに追加
      events.forEach(function (event) {
        const eventTitle = event.title.toLowerCase();
        if (eventTitle.includes(searchText)) {
          event.remove(); // 一度削除してから再度追加することで表示を更新
          calendar.addEvent(event);
        }
      });
    });
  } else {
    console.error("calendarEl が存在しません。");
  }
});