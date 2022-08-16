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
    selectable: true,
    select: function(info){
        const eventName = prompt("イベントを入力して下さい");
        
        if(eventName){
            window.axios
                .post("/fullcalendar", {
                    start_date: info.start.valueOf(),
                    end_date: info.end.valueOf(),
                    event_name: eventName,
                })
                .then(() => {
                    calendar.addEvent({
                        title: eventName,
                        start: info.start,
                        end: info.end,
                        allDay: true,
                    });
                })
                .catch(() => {
                    //validation error
                    alert("登録に失敗しました");
                })
        }
    },
    events: function(info, successCallback, failureCallback) {
        window.axios
            .post('/fullcalendar-get', {
                start_date: info.start.valueOf(),
                end_date: info.end.valueOf(),
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