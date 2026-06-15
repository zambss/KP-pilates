document.addEventListener("DOMContentLoaded", () => {

    /*
    |--------------------------------------------------------------------------
    | STATE
    |--------------------------------------------------------------------------
    */

    let selectedDate = new Date();

    let allEvents = [];

    let activeClassFilter = "all";

    let activeCoachFilter = "all";

    let currentScheduleId = null;



    /*
    |--------------------------------------------------------------------------
    | ELEMENTS
    |--------------------------------------------------------------------------
    */

    const modal = document.getElementById("classModal");

    const detailModal = document.getElementById("detailModal");

    const openBtn = document.getElementById("openClass");

    const closeBtn = document.getElementById("closeModal");

    const form = document.getElementById("classForm");

    const rangeTanggal = document.getElementById("rangeTanggal");

    const weekDays = document.getElementById("weekDays");



    /*
    |--------------------------------------------------------------------------
    | FORM ELEMENTS
    |--------------------------------------------------------------------------
    */

    const classNameInput =
        document.getElementById("className");

    const coachInput =
        document.getElementById("coach");

    const quotaInput =
        document.getElementById("quota");

    const roomInput =
        document.getElementById("room");

    const startTimeInput =
        document.getElementById("startTime");

    const durationInput =
        document.getElementById("duration");



    /*
    |--------------------------------------------------------------------------
    | DETAIL MODAL ELEMENTS
    |--------------------------------------------------------------------------
    */

    const editRoomSelect =
        document.getElementById("editRoom");

    const editQuotaInput =
        document.getElementById("editQuota");



    /*
    |--------------------------------------------------------------------------
    | DATE HELPER
    |--------------------------------------------------------------------------
    */

    function formatDate(date) {

        const d = new Date(date);

        const year = d.getFullYear();

        const month = String(
            d.getMonth() + 1
        ).padStart(2, "0");

        const day = String(
            d.getDate()
        ).padStart(2, "0");

        return `${year}-${month}-${day}`;
    }



    /*
    |--------------------------------------------------------------------------
    | ROOM AUTO CAPACITY
    |--------------------------------------------------------------------------
    */

    function updateRoomCapacity() {

        if (!roomInput || !quotaInput) return;

        const selectedOption =
            roomInput.options[
                roomInput.selectedIndex
            ];

        quotaInput.value =
            selectedOption.dataset.capacity || 0;
    }



    /*
    |--------------------------------------------------------------------------
    | DETAIL ROOM AUTO CAPACITY
    |--------------------------------------------------------------------------
    */

    function updateEditRoomCapacity() {

        if (!editRoomSelect || !editQuotaInput) return;

        const selectedOption =
            editRoomSelect.options[
                editRoomSelect.selectedIndex
            ];

        editQuotaInput.value =
            selectedOption.dataset.capacity || 0;
    }



    /*
    |--------------------------------------------------------------------------
    | WEEK HEADER
    |--------------------------------------------------------------------------
    */

    function renderWeekHeader() {

        const start = new Date(selectedDate);

        start.setDate(
            start.getDate() - start.getDay()
        );

        const end = new Date(start);

        end.setDate(
            start.getDate() + 6
        );



        /*
        |--------------------------------------------------------------------------
        | RANGE TEXT
        |--------------------------------------------------------------------------
        */

        rangeTanggal.innerText =
            `${start.toLocaleDateString("id-ID", {
                day: "numeric",
                month: "long"
            })} - ${end.toLocaleDateString("id-ID", {
                day: "numeric",
                month: "long",
                year: "numeric"
            })}`;



        /*
        |--------------------------------------------------------------------------
        | WEEK DAYS
        |--------------------------------------------------------------------------
        */

        weekDays.innerHTML = "";

        const dayNames = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu"
        ];

        for (let i = 0; i < 7; i++) {

            const current = new Date(start);

            current.setDate(
                start.getDate() + i
            );

            const item =
                document.createElement("div");

            item.classList.add("jadwal-day");

            item.innerHTML = `
                <div class="hari">
                    ${dayNames[current.getDay()]}
                </div>

                <div class="tanggal">
                    ${current.getDate()}
                </div>
            `;

            weekDays.appendChild(item);
        }
    }



    /*
    |--------------------------------------------------------------------------
    | CLEAR GRID
    |--------------------------------------------------------------------------
    */

    function clearGrid() {

        document
            .querySelectorAll(".jadwal-events")
            .forEach(el => {

                el.innerHTML = "";

            });
    }



    /*
    |--------------------------------------------------------------------------
    | LOAD SCHEDULE
    |--------------------------------------------------------------------------
    */

    async function loadSchedule() {

        clearGrid();

        try {

            const response = await fetch(
                `/admin/schedules?date=${formatDate(selectedDate)}`
            );

            const data = await response.json();

            allEvents = data;

            renderFilteredEvents();

        } catch (error) {

            console.log(error);

        }
    }



    /*
    |--------------------------------------------------------------------------
    | FILTER EVENTS
    |--------------------------------------------------------------------------
    */

    function renderFilteredEvents() {

        clearGrid();

        const filtered = allEvents.filter(event => {

            const eventTitle = (
                event.title || ""
            ).toLowerCase().trim();

            const eventCoach = (
                event.coach || ""
            ).toLowerCase().trim();



            /*
            |--------------------------------------------------------------------------
            | FILTER CLASS
            |--------------------------------------------------------------------------
            */

            if (
                activeClassFilter !== "all" &&
                eventTitle !== activeClassFilter
            ) {
                return false;
            }



            /*
            |--------------------------------------------------------------------------
            | FILTER COACH
            |--------------------------------------------------------------------------
            */

            if (
                activeCoachFilter !== "all" &&
                eventCoach !== activeCoachFilter
            ) {
                return false;
            }

            return true;
        });

        updateCounts(allEvents);

        filtered.forEach(renderEvent);
    }

/*
|--------------------------------------------------------------------------
| RENDER EVENT
|--------------------------------------------------------------------------
*/

function renderEvent(event) {

    const time =
        event.start_time.substring(0, 5);

    const dayIndex =
        new Date(event.date).getDay();



    /*
    |--------------------------------------------------------------------------
    | FIND SLOT
    |--------------------------------------------------------------------------
    */

    const row = document.querySelector(
        `.jadwal-row[data-hour="${time}"]`
    );

    if (!row) return;

    const slot = row.querySelector(
        `.jadwal-slot[data-day="${dayIndex}"] .jadwal-events`
    );

    if (!slot) return;



    /*
    |--------------------------------------------------------------------------
    | EVENT CARD
    |--------------------------------------------------------------------------
    */

    const el =
        document.createElement("div");

    el.classList.add("jadwal-event");

    el.innerHTML = `

        <div class="event-top">

            <button
                class="status-toggle ${event.is_open ? 'open' : 'closed'}"
                data-id="${event.id}"
            >
                ${event.is_open ? 'OPEN' : 'CLOSED'}
            </button>

            <button class="delete-mini">
                ×
            </button>

        </div>

        <strong>
            ${event.title}
        </strong>

        <span>
            ${event.coach || "-"}
        </span>

        <span>
            ${event.room || "-"}
        </span>

        <span>
            ${event.quota || "-"} Orang
        </span>

    `;



    /*
    |--------------------------------------------------------------------------
    | DATASET
    |--------------------------------------------------------------------------
    */

    el.dataset.id =
        event.id;

    el.dataset.title =
        event.title;

    el.dataset.time =
        `${event.start_time.substring(0,5)} - ${event.end_time.substring(0,5)}`;

    el.dataset.coach =
        event.coach || "-";

    el.dataset.room =
        event.room || "-";

    el.dataset.quota =
        event.quota || "-";



    /*
    |--------------------------------------------------------------------------
    | OPEN DETAIL
    |--------------------------------------------------------------------------
    */

    el.addEventListener(
        "click",
        () => {

            openDetail(el);

        }
    );



    /*
    |--------------------------------------------------------------------------
    | DELETE EVENT
    |--------------------------------------------------------------------------
    */

    const deleteMini =
        el.querySelector(".delete-mini");

    deleteMini.addEventListener(
        "click",
        async (e) => {

            e.stopPropagation();

            const confirmDelete = confirm(
                "Hapus kelas ini?"
            );

            if (!confirmDelete) return;

            try {

                await fetch(
                    `/admin/schedule/${event.id}`,
                    {
                        method: "DELETE",

                        headers: {
                            "X-CSRF-TOKEN":
                                document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content
                        }
                    }
                );

                loadSchedule();

            } catch (error) {

                console.log(error);

            }
        }
    );



    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS
    |--------------------------------------------------------------------------
    */

    el.querySelector(".status-toggle")
        .addEventListener(
            "click",
            async (e) => {

                e.stopPropagation();

                try {

                    await fetch(
                        `/admin/schedule/${event.id}/toggle`,
                        {
                            method: "PATCH",

                            headers: {
                                "X-CSRF-TOKEN":
                                    document.querySelector(
                                        'meta[name="csrf-token"]'
                                    ).content
                            }
                        }
                    );

                    loadSchedule();

                } catch (error) {

                    console.log(error);

                }
            }
        );



    slot.appendChild(el);
}



/*
|--------------------------------------------------------------------------
| OPEN DETAIL MODAL
|--------------------------------------------------------------------------
*/

function openDetail(el) {

    currentScheduleId =
        el.dataset.id;

    detailModal.style.display =
        "flex";



    /*
    |--------------------------------------------------------------------------
    | DETAIL TEXT
    |--------------------------------------------------------------------------
    */

    document.getElementById(
        "detailTitle"
    ).innerText =
        el.dataset.title;

    document.getElementById(
        "detailTime"
    ).innerText =
        el.dataset.time;

    document.getElementById(
        "detailCoach"
    ).innerText =
        el.dataset.coach;

    document.getElementById(
        "detailRoomName"
    ).innerText =
        el.dataset.room;

    document.getElementById(
        "detailQuota"
    ).innerText =
        `${el.dataset.quota} Orang`;



    /*
    |--------------------------------------------------------------------------
    | AUTO SELECT ROOM
    |--------------------------------------------------------------------------
    */

    const roomOptions =
        editRoomSelect.options;

    for (let i = 0; i < roomOptions.length; i++) {

        const option =
            roomOptions[i];

        if (
            option.dataset.roomName ===
            el.dataset.room
        ) {

            editRoomSelect.selectedIndex = i;

            editQuotaInput.value =
                option.dataset.capacity || 0;

            break;
        }
    }
}
    /*
    |--------------------------------------------------------------------------
    | UPDATE FILTER COUNTS
    |--------------------------------------------------------------------------
    */

    function updateCounts(events) {

        const counts = {};

        events.forEach(event => {

            const key = (
                event.title || ""
            ).toLowerCase().trim();

            counts[key] =
                (counts[key] || 0) + 1;
        });



        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        const totalEl =
            document.getElementById(
                "count-all"
            );

        if (totalEl) {

            totalEl.innerText =
                events.length;

        }



        /*
        |--------------------------------------------------------------------------
        | PER CLASS
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(".count")
            .forEach(el => {

                const key = el.id
                    .replace("count-", "")
                    .replaceAll("-", " ")
                    .toLowerCase()
                    .trim();

                if (key === "all") return;

                el.innerText =
                    counts[key] || 0;
            });
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE CLASS
    |--------------------------------------------------------------------------
    */

    form.addEventListener(
        "submit",
        async (e) => {

            e.preventDefault();

            try {

                const response = await fetch(
                    "/admin/schedule",
                    {
                        method: "POST",

                        headers: {
                            "Content-Type":
                                "application/json",

                            "X-CSRF-TOKEN":
                                document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content
                        },

                        body: JSON.stringify({

                            class_id:
                                classNameInput.value,

                            coach_id:
                                coachInput.value,

                            quota:
                                quotaInput.value,

                            room:
                                roomInput.options[
                                    roomInput.selectedIndex
                                ].text,

                            duration:
                                durationInput.value,

                            start_time:
                                startTimeInput.value,

                            date:
                                document.getElementById(
                                    "scheduleDate"
                                ).value
                        })
                    }
                );

                await response.json();

                modal.style.display = "none";

                form.reset();

                updateRoomCapacity();

                loadSchedule();

            } catch (error) {

                console.log(error);

                alert(
                    "Gagal menyimpan jadwal"
                );
            }
        }
    );



    /*
    |--------------------------------------------------------------------------
    | UPDATE ROOM
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("saveRoomBtn")
        ?.addEventListener(
            "click",
            async () => {

                const room =
                    editRoomSelect.options[
                        editRoomSelect.selectedIndex
                    ].text;

                try {

                    const response = await fetch(
                        `/admin/schedule/${currentScheduleId}/update-room`,
                        {
                            method: "POST",

                            headers: {
                                "Content-Type":
                                    "application/json",

                                "X-CSRF-TOKEN":
                                    document.querySelector(
                                        'meta[name="csrf-token"]'
                                    ).content
                            },

                            body: JSON.stringify({
                                room: room
                            })
                        }
                    );

                    const result =
                        await response.json();

                    alert(result.message);

                    if (result.success) {

                        detailModal.style.display =
                            "none";

                        loadSchedule();
                    }

                } catch (error) {

                    console.log(error);

                }
            }
        );



    /*
    |--------------------------------------------------------------------------
    | FILTER CLASS
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(".filter-checkbox")
        .forEach(cb => {

            cb.addEventListener(
                "change",
                () => {

                    document
                        .querySelectorAll(".filter-checkbox")
                        .forEach(item => {

                            item.checked = false;

                        });

                    cb.checked = true;

                    activeClassFilter =
                        cb.value
                        .toLowerCase()
                        .trim();

                    renderFilteredEvents();
                }
            );
        });



    /*
    |--------------------------------------------------------------------------
    | FILTER COACH
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("filterCoach")
        ?.addEventListener(
            "change",
            (e) => {

                activeCoachFilter =
                    e.target.value
                    .toLowerCase()
                    .trim();

                renderFilteredEvents();
            }
        );



    /*
    |--------------------------------------------------------------------------
    | WEEK NAVIGATION
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("prevWeek")
        ?.addEventListener(
            "click",
            () => {

                selectedDate.setDate(
                    selectedDate.getDate() - 7
                );

                renderWeekHeader();

                loadSchedule();
            }
        );



    document
        .getElementById("nextWeek")
        ?.addEventListener(
            "click",
            () => {

                selectedDate.setDate(
                    selectedDate.getDate() + 7
                );

                renderWeekHeader();

                loadSchedule();
            }
        );



    /*
    |--------------------------------------------------------------------------
    | MODAL CONTROL
    |--------------------------------------------------------------------------
    */

    openBtn?.addEventListener(
        "click",
        () => {

            modal.style.display = "flex";

            document.getElementById(
                "scheduleDate"
            ).value = formatDate(
                selectedDate
            );

            updateRoomCapacity();
        }
    );



    closeBtn?.addEventListener(
        "click",
        () => {

            modal.style.display = "none";

        }
    );



    window.addEventListener(
        "click",
        (e) => {

            if (e.target === modal) {

                modal.style.display =
                    "none";

            }

            if (e.target === detailModal) {

                detailModal.style.display =
                    "none";

            }
        }
    );



    /*
    |--------------------------------------------------------------------------
    | ROOM CHANGE EVENT
    |--------------------------------------------------------------------------
    */

    roomInput?.addEventListener(
        "change",
        updateRoomCapacity
    );

    editRoomSelect?.addEventListener(
        "change",
        updateEditRoomCapacity
    );



    /*
    |--------------------------------------------------------------------------
    | INIT
    |--------------------------------------------------------------------------
    */

    renderWeekHeader();

    updateRoomCapacity();

    updateEditRoomCapacity();

    loadSchedule();

});