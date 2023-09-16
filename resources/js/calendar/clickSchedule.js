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
      dayMaxEvents: true, // イベントが多すぎる場合に「詳細」リンクを許可する
      selectable: true, // 日付クリックで日付モード
      navLinks: true,
      editable: true,
      headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
      },
      // 日本語化
      locale: "ja",
    
        // 日付をクリック、または範囲を選択したイベント
        dateClick: function (info) {
          MicroModal.show('clickScheduleModal');
          
          const eventName = document.getElementById('eventName');
          const startDate = document.getElementById('startDate');
          const endDate = document.getElementById('endDate');
          const scheduleColor = document.getElementById('scheduleColor');

          const submitSchedule = document.getElementById('submitSchedule');
          submitSchedule.addEventListener('click', buttonClick);

          function buttonClick() {
            // Laravelの登録処理の呼び出し
            const data = {
              startDate: startDate,
              endDate: endDate,
              eventName: eventName,
              scheduleColor: scheduleColor,
            };

            axios
              .post("/schedule-add", data)
              .then(() => {
                  // イベントの追加
                  calendar.addEvent({
                      title: eventName,
                      start: startDate,
                      end: endDate,
                  });
              })
              .catch(() => {
                  // バリデーションエラーetc
                  alert("登録に失敗しました");
              });
            };
        },
    
        events: function (info, successCallback, failureCallback) {
            // Laravelのイベント取得処理の呼び出し
            axios
                .post("/schedule-get", {
                    eventId : info.id,
                    startDate: info.start.valueOf(),
                    endDate: info.end.valueOf(),
                })
                .then((response) => {
                    // 追加したイベントを削除
                    calendar.removeAllEvents();
                    // カレンダーに読み込み
                    successCallback(response.data);
                })
                .catch((error) => {
                    // バリデーションエラーetc
                    console.error("Error", error);
                    alert("登録に失敗しました");
                });
    
        },

        eventClick: function(info) {
          const eventId = info.event.id;
          const editEventName = info.event.title;
          const editScheduleColor = info.event.backgroundColor;

          const editStartDate = info.event.start ? formatDate(info.event.start) : "";
          const editEndDate = info.event.end ? formatDate(info.event.end) : "";

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
        }
    });
    calendar.render();
  } else {
    console.error("calendarEl が存在しません。");
  }
});