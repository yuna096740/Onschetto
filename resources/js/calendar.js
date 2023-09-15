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
      initialView: "dayGridMonth",
      selectable: true,
      headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
      },
      // 日本語化
      // timeZone: 'local',
      locale: "ja",
    
        // 日付をクリック、または範囲を選択したイベント
        dateClick: function (info) {
          MicroModal.show('createScheduleModal');
          
          const startDate = document.getElementById('startDate');
          const endDate = document.getElementById('endDate');
          const eventName = document.getElementById('eventName');
          const detail = document.getElementById('detail');
          const scheduleColor = document.getElementById('scheduleColor');

          const submitSchedule = document.getElementById('submitSchedule');
          submitSchedule.addEventListener('click', buttonClick);

          function buttonClick() {
            // Laravelの登録処理の呼び出し
              const data = {
                startDate: startDate,
                endDate: endDate,
                eventName: eventName,
                detail: detail,
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
            console.log("info",info );
            axios
                .post("/schedule-get", {
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

        // eventClick: function(info) {
        //   document.getElementById("id").value = info.id;
        //   document.getElementById("").value = info.


        // }
    });
    calendar.render();
  } else {
    console.error("calendarEl が存在しません。");
  }
});