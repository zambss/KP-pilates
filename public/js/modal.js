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

            const offset = 80; // tinggi navbar
            const position = targetEl.getBoundingClientRect().top + window.pageYOffset - offset;

            window.scrollTo({
                top: position,
                behavior: "smooth"
            });
        });
    });


    /* =========================
       LOGIN MODAL
    ========================= */
    const modal     = document.getElementById("loginModal");
    const closeBtn  = document.getElementById("closeLogin");
    const openBtns  = document.querySelectorAll(".open-login, #openLogin");

    if (modal) {

        // OPEN MODAL
        openBtns.forEach(btn => {
            btn.addEventListener("click", e => {
                e.preventDefault();
                modal.classList.add("active");
            });
        });

        // CLOSE VIA BUTTON
        if (closeBtn) {
            closeBtn.addEventListener("click", () => {
                modal.classList.remove("active");
            });
        }

        // CLOSE VIA BACKDROP
        modal.addEventListener("click", e => {
            if (e.target === modal) {
                modal.classList.remove("active");
            }
        });

        // CLOSE VIA ESC
        document.addEventListener("keydown", e => {
            if (e.key === "Escape") {
                modal.classList.remove("active");
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
            passInput.type = passInput.type === "password" ? "text" : "password";
        });
    }


    /* =========================
       NAVBAR HAMBURGER (MOBILE)
    ========================= */
    const navToggle = document.getElementById("navToggle");
    const navMenu   = document.getElementById("navMenu");

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

            list.querySelectorAll(".price-option")
                .forEach(btn => btn.classList.remove("active"));

            button.classList.add("active");

            const sesi  = button.dataset.sesi;
            const harga = button.dataset.harga;

            console.log("Pilih paket:", sesi, harga);
        });
    });


    /* =========================
       FAQ ACCORDION
    ========================= */
    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach(item => {
        const question = item.querySelector(".faq-question");
        if (!question) return;

        question.addEventListener("click", () => {
            faqItems.forEach(other => {
                if (other !== item) {
                    other.classList.remove("active");
                }
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

            // aktifkan tombol
            filterButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            const filter = btn.dataset.filter;

            notifications.forEach(item => {
                if (filter === "all") {
                    item.style.display = "flex";
                }

                if (filter === "unread") {
                    item.style.display = item.classList.contains("unread")
                        ? "flex"
                        : "none";
                }
            });
        });
    });

});
const openBtn = document.getElementById('openConfirm');
const closeBtn = document.getElementById('closeModal');
const modal = document.getElementById('confirmModal');

openBtn.addEventListener('click', () => {
    modal.classList.add('show');
});

closeBtn.addEventListener('click', () => {
    modal.classList.remove('show');
});



/*REGISTRASI AKUN (POP UP LOGIN) */
const loginModal = document.getElementById('loginModal');
const registerModal = document.getElementById('registerModal');

const openRegister = document.getElementById('openRegister');
const backToLogin = document.getElementById('backToLogin');

const closeLogin = document.getElementById('closeLogin');
const closeRegister = document.getElementById('closeRegister');

openRegister.addEventListener('click', () => {
    loginModal.classList.remove('show');
    registerModal.classList.add('show');
});

backToLogin.addEventListener('click', () => {
    registerModal.classList.remove('show');
    loginModal.classList.add('show');
});

closeLogin.addEventListener('click', () => {
    loginModal.classList.remove('show');
});

closeRegister.addEventListener('click', () => {
    registerModal.classList.remove('show');
});
