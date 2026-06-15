document.addEventListener("DOMContentLoaded", () => {

    /* =====================================================
       SMOOTH SCROLL (ANCHOR)
    ===================================================== */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", e => {
            const targetId = anchor.getAttribute("href");
            const targetEl = document.querySelector(targetId);
            if (!targetEl) return;

            e.preventDefault();
            const offset = 80;
            const position =
                targetEl.getBoundingClientRect().top +
                window.pageYOffset -
                offset;

            window.scrollTo({ top: position, behavior: "smooth" });
        });
    });

    /* =====================================================
       LOGIN MODAL
    ===================================================== */
    const loginModal = document.getElementById("loginModal");
    const closeLogin = document.getElementById("closeLogin");
    const openLoginBtns = document.querySelectorAll(".open-login, #openLogin");

    if (loginModal) {
        openLoginBtns.forEach(btn => {
            btn.addEventListener("click", e => {
                e.preventDefault();
                loginModal.classList.add("active");
            });
        });

        closeLogin?.addEventListener("click", () => {
            loginModal.classList.remove("active");
        });

        loginModal.addEventListener("click", e => {
            if (e.target === loginModal) loginModal.classList.remove("active");
        });

        document.addEventListener("keydown", e => {
            if (e.key === "Escape") loginModal.classList.remove("active");
        });
    }

    /* =====================================================
       REGISTER MODAL
    ===================================================== */
    const registerModal = document.getElementById("registerModal");
    const openRegister  = document.getElementById("openRegister");
    const backToLogin   = document.getElementById("backToLogin");
    const closeRegister = document.getElementById("closeRegister");

    openRegister?.addEventListener("click", () => {
        loginModal?.classList.remove("active");
        registerModal?.classList.add("active");
    });

    backToLogin?.addEventListener("click", () => {
        registerModal?.classList.remove("active");
        loginModal?.classList.add("active");
    });

    closeRegister?.addEventListener("click", () => {
        registerModal?.classList.remove("active");
    });

    registerModal?.addEventListener("click", e => {
        if (e.target === registerModal) registerModal.classList.remove("active");
    });

    /* =====================================================
       TOGGLE PASSWORD
    ===================================================== */
    const togglePass = document.getElementById("togglePassword");
    const passInput  = document.getElementById("password");

    togglePass?.addEventListener("click", () => {
        passInput.type = passInput.type === "password" ? "text" : "password";
    });

    /* =====================================================
       NAVBAR HAMBURGER
    ===================================================== */
    const navToggle = document.getElementById("navToggle");
    const navMenu   = document.getElementById("navMenu");

    navToggle?.addEventListener("click", () => {
        navMenu?.classList.toggle("active");
    });

    /* =====================================================
       BOOKING / PILIH PAKET (FIXED & SINGLE SOURCE)
    ===================================================== */
    document.querySelectorAll(".price-option").forEach(button => {
        button.addEventListener("click", () => {

            const card = button.closest(".pricing-card");
            if (!card) return;

            const paket = card.dataset.paket;
            const sesi  = button.dataset.sesi;
            const harga = button.dataset.harga;

            // simpan intent booking (untuk setelah login / register)
            sessionStorage.setItem("booking_intent", JSON.stringify({
                paket,
                sesi,
                harga
            }));

      

            // ✅ sudah login → ke form booking
            const classSlug = encodeURIComponent(paket);
            window.location.href =
                `/booking/${classSlug}?sesi=${sesi}&harga=${harga}`;
        });
    });

    /* =====================================================
       FAQ ACCORDION
    ===================================================== */
    document.querySelectorAll(".faq-item").forEach(item => {
        const question = item.querySelector(".faq-question");
        if (!question) return;

        question.addEventListener("click", () => {
            document.querySelectorAll(".faq-item").forEach(other => {
                if (other !== item) other.classList.remove("active");
            });
            item.classList.toggle("active");
        });
    });

    /* =====================================================
       FILTER NOTIFIKASI
    ===================================================== */
    const filterButtons = document.querySelectorAll(".filter-btn");
    const notifications = document.querySelectorAll(".notification-item");

    filterButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            filterButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            const filter = btn.dataset.filter;
            notifications.forEach(item => {
                if (filter === "all") item.style.display = "flex";
                if (filter === "unread") {
                    item.style.display = item.classList.contains("unread")
                        ? "flex"
                        : "none";
                }
            });
        });
    });

});

/*  ===================
KALENDER HARI
=======================*/

document.querySelectorAll('.date-item').forEach(btn => {

    btn.addEventListener('click', function() {

        document
            .querySelectorAll('.date-item')
            .forEach(el => {
                el.classList.remove('active');
            });

        document
            .querySelectorAll('.date-content')
            .forEach(el => {
                el.style.display = 'none';
            });

        this.classList.add('active');

        document.getElementById(
            'date-' + this.dataset.date
        ).style.display = 'block';

    });

});

window.openPopup = function() {
    const popup = document.getElementById('classPopup');
    if (popup) {
        popup.classList.add('active');
    }
};

window.closePopup = function() {
    const popup = document.getElementById('classPopup');
    if (popup) {
        popup.classList.remove('active');
    }
};

document.addEventListener("DOMContentLoaded", function () {

    const dayButtons = document.querySelectorAll(".day-btn");
    const dayContainers = document.querySelectorAll(".day-classes");

    const dayTitle = document.querySelector(".calendar-date h3");
    const dayFullDate = document.querySelector(".calendar-date p");

    dayButtons.forEach(button => {

        button.addEventListener("click", function () {

            const selectedDate = this.dataset.date;
            const selectedFullDate = this.dataset.fullDate;

            // 1️⃣ Active tab
            dayButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");

            // 2️⃣ Update header
            dayTitle.textContent = this.textContent.trim();
            dayFullDate.textContent = selectedFullDate;

            // 3️⃣ Tampilkan kelas berdasarkan TANGGAL
            dayContainers.forEach(container => {
                container.style.display =
                    container.dataset.date === selectedDate
                        ? "block"
                        : "none";
            });

        });

    });

});