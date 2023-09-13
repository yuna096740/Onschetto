import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
// 非同期通信を行うためのaxiosを追加
import axios from 'axios';

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById("calendar");
  const eventName = document.getElementById("eventName").value;
  const detail = document.getElementById("detail").value;
  const scheduleColor = document.getElementById("scheduleColor").value;

  if (calendarEl) {
    let calendar = new Calendar(calendarEl, {
      plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
      initialView: "dayGridMonth",
      headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,listWeek",
      },
      // 日本語化
      locale: "ja",
    
        // 日付をクリック、または範囲を選択したイベント
        selectable: true,
        dateClick: function (info) {
          MicroModal.show('modal-1');
          const event = info.event;
        
          // const startDate = document.getElementById('startDate');
          // const endDate = document.getElementById('endDate');
          const eventName = document.getElementById('eventName');
          const detail = document.getElementById('detail');
          const scheduleColor = document.getElementById('scheduleColor');
          const submitSchedule = document.getElementById('submitSchedule');
          console.log(eventName)

          if (submitSchedule) {
            console.log();
            // Laravelの登録処理の呼び出し
              const data = {
                startDate: info.start.valueOf(),
                endDate: info.end.valueOf(),
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
                          start: info.start,
                          end: info.end,
                          allDay: true,
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
    });
    calendar.render();
  } else {
    console.error("calendarEl が存在しません。");
  }
});



 //          
          
          // document.getElementById("startDate").value = info.start;
          // document.getElementById("endDate").value = info.end;
          // document.getElementById("eventName").value = eventName;
          // document.getElementById("detail").value = detail;
          // document.getElementById("scheduleColor").value = scheduleColor;
          