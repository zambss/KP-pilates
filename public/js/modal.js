document.addEventListener("DOMContentLoaded", () => {

    /* =========================
       SMOOTH SCROLL (ANCHOR)
    ========================= */
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

            window.scrollTo({
                top: position,
                behavior: "smooth"
            });
        });
    });

    /* =========================
       LOGIN MODAL (SUDAH JALAN)
    ========================= */
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

        if (closeLogin) {
            closeLogin.addEventListener("click", () => {
                loginModal.classList.remove("active");
            });
        }

        loginModal.addEventListener("click", e => {
            if (e.target === loginModal) {
                loginModal.classList.remove("active");
            }
        });

        document.addEventListener("keydown", e => {
            if (e.key === "Escape") {
                loginModal.classList.remove("active");
            }
        });
    }

    /* =========================
       REGISTER MODAL (FIXED)
    ========================= */
    const registerModal = document.getElementById("registerModal");
    const openRegister = document.getElementById("openRegister");
    const backToLogin = document.getElementById("backToLogin");
    const closeRegister = document.getElementById("closeRegister");

    // dari login → register
    if (openRegister && registerModal && loginModal) {
        openRegister.addEventListener("click", () => {
            loginModal.classList.remove("active");
            registerModal.classList.add("active");
        });
    }

    // dari register → login
    if (backToLogin && registerModal && loginModal) {
        backToLogin.addEventListener("click", () => {
            registerModal.classList.remove("active");
            loginModal.classList.add("active");
        });
    }

    // close register
    if (closeRegister && registerModal) {
        closeRegister.addEventListener("click", () => {
            registerModal.classList.remove("active");
        });
    }

    // close register via backdrop
    if (registerModal) {
        registerModal.addEventListener("click", e => {
            if (e.target === registerModal) {
                registerModal.classList.remove("active");
            }
        });
    }

    /* =========================
       TOGGLE PASSWORD
    ========================= */
    const togglePass = document.getElementById("togglePassword");
    const passInput = document.getElementById("password");

    if (togglePass && passInput) {
        togglePass.addEventListener("click", () => {
            passInput.type =
                passInput.type === "password" ? "text" : "password";
        });
    }

    /* =========================
       NAVBAR HAMBURGER
    ========================= */
    const navToggle = document.getElementById("navToggle");
    const navMenu = document.getElementById("navMenu");

    if (navToggle && navMenu) {
        navToggle.addEventListener("click", () => {
            navMenu.classList.toggle("active");
        });
    }

    /* =========================
       PRICE OPTION SELECT
    ========================= */
    document.querySelectorAll(".price-option").forEach(button => {
        button.addEventListener("click", () => {
            const list = button.closest(".price-list");
            if (!list) return;

            list
                .querySelectorAll(".price-option")
                .forEach(btn => btn.classList.remove("active"));

            button.classList.add("active");

            console.log("Pilih paket:", button.dataset.sesi, button.dataset.harga);
        });
    });

    /* =========================
       FAQ ACCORDION
    ========================= */
    document.querySelectorAll(".faq-item").forEach(item => {
        const question = item.querySelector(".faq-question");
        if (!question) return;

        question.addEventListener("click", () => {
            document
                .querySelectorAll(".faq-item")
                .forEach(other => {
                    if (other !== item) other.classList.remove("active");
                });

            item.classList.toggle("active");
        });
    });

    /* =========================
       FILTER NOTIFIKASI
    ========================= */
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

    document.querySelectorAll('.price-option').forEach(button => {
    button.addEventListener('click', () => {
        const card  = button.closest('.pricing-card');

        const paket = card.dataset.paket;
        const sesi  = button.dataset.sesi;
        const harga = button.dataset.harga;

        // redirect ke form booking
        window.location.href =
            `/booking/form?paket=${encodeURIComponent(paket)}&sesi=${sesi}&harga=${harga}`;
    });
});

});
