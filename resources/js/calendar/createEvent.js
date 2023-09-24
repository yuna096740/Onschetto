import { formatDate } from "./formatDate";
import axios from 'axios';

export function createEvent(calendar) {
  // 登録機能
  calendar.addEventListener('dateClick', function(info) {
    console.log("clicked");

    // クリックされた日付を取得
    const createStartDate = formatDate(info.date);
    const createEndDate = formatDate(info.date);
  
    // 初期値をセット(date)
    document.getElementById('startDate').value = createStartDate;
    document.getElementById('endDate').value = createEndDate;
    MicroModal.show('clickScheduleModal');
  
    const submitSchedule = document.getElementById('submitSchedule');
    submitSchedule.addEventListener('click', buttonClick);
  
    function buttonClick() {
      // Laravelの登録処理の呼び出し
      const data = {
        startDate: info.dateStr, // info.dateStr を使用
        endDate: info.dateStr, // info.dateStr を使用
        eventName: info.event.title,
        scheduleColor: info.event.backgroundColor,
        description: info.event.extendedProps.description,
      };
  
      axios
        .post("/schedule-add", data)
        .then(() => {
          // イベントの追加
          calendar.addEvent({
            title: data.eventName, // dataオブジェクトから取得
            description: data.description, // dataオブジェクトから取得
            start: data.startDate, // dataオブジェクトから取得
            end: data.endDate, // dataオブジェクトから取得
          });
        })
        .catch(() => {
            // バリデーションエラー等
            alert("登録に失敗しました");
        });
    }
  });
}