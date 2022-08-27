import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";

var calendarEl = document.getElementById("fullcalendar");

let calendar = new Calendar(calendarEl, {
    plugins: [interactionPlugin,dayGridPlugin,timeGridPlugin,listPlugin],
    initialView: "dayGridMonth",
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth, timeGridWeek, listWeek",
    },
    locale: "ja",
    
    //日付をクリック、または範囲を選択したイベント
    // selectable: true,
    
    events: function(info, successCallback, failureCallback) {
        window.axios
            .post('/fullcalendar-get', {
                start_date: info.startStr,
                end_date: info.endStr,
            })
            .then((response) => {
                calendar.removeAllEvents();
                successCallback(response.data);
            })
            .catch(() => {
                alert("登録に失敗しました");
            });
    },
    
});
calendar.render();