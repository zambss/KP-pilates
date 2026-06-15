document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("classModal");
    if (!modal) return;

    const overlay     = modal.querySelector(".class-modal-overlay");
    const closeBtn    = modal.querySelector("#closeClassModal");

    const modalTitle  = modal.querySelector("#modalClassTitle");
    const modalTime   = modal.querySelector("#modalClassTime");
    const modalBody   = modal.querySelector(".class-modal-content");
    const bookingForm = modal.querySelector("#bookingForm");

    let scheduleId = null;

    const openModal  = () => modal.classList.add("active");
    const closeModal = () => modal.classList.remove("active");

    document.querySelectorAll(".schedule-slot").forEach(slot => {
        slot.addEventListener("click", () => {

            scheduleId = slot.dataset.id;

            const filled   = Number(slot.dataset.filled);
            const capacity = Number(slot.dataset.capacity);

            modalTitle.textContent = slot.dataset.title;
            modalTime.textContent  =
                `${slot.dataset.date} · ${slot.dataset.time}`;

            modalBody.innerHTML = "";

            const item = document.createElement("div");
            item.className = "class-item";

            item.innerHTML = `
                <div class="class-info">
                    <h4>${slot.dataset.title}</h4>
                    <div class="class-meta">
                        <span>👤 ${slot.dataset.coach}</span>
                        <span>👥 ${filled}/${capacity} Slot</span>
                    </div>
                </div>
            `;

            if (filled < capacity) {
                const btn = document.createElement("button");
                btn.type = "button";
                btn.className = "btn-register";
                btn.textContent = "Daftar";

                btn.onclick = () => {
                    bookingForm.action =
                        `/dashboard/booking/${scheduleId}`;
                    bookingForm.submit();
                };

                item.appendChild(btn);
            } else {
                item.insertAdjacentHTML(
                    "beforeend",
                    `<div class="class-full-label">⚠️ Kelas Sudah Penuh</div>`
                );
            }

            modalBody.appendChild(item);
            openModal();
        });
    });

    closeBtn.onclick = closeModal;
    overlay.onclick  = closeModal;
});
