document.addEventListener("DOMContentLoaded", () => {

    /* ================
    efek scroll smooth
    ==================*/
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function () {

        const targetId = this.getAttribute("href");
        const targetEl = document.querySelector(targetId);

        const offset = 80; // tinggi navbar
        const elementPosition = targetEl.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: "smooth"
        });
    });
});

    /* =======================
       MODAL LOGIN
    ======================= */
    const openBtn  = document.getElementById("openLogin");
    const modal    = document.getElementById("loginModal");
    const closeBtn = document.getElementById("closeLogin");

    if (openBtn && modal) {
        openBtn.addEventListener("click", (e) => {
            e.preventDefault();
            modal.classList.add("active");
        });
    }

    if (closeBtn && modal) {
        closeBtn.addEventListener("click", () => {
            modal.classList.remove("active");
        });
    }


    /* =======================
       TOGGLE PASSWORD
    ======================= */
    const toggle = document.getElementById("togglePassword");
    const pass   = document.getElementById("password");

    if (toggle && pass) {
        toggle.addEventListener("click", () => {
            pass.type = pass.type === "password" ? "text" : "password";
        });
    }


    /* =======================
       ROLE SWITCH
    ======================= */
    const roleItems = document.querySelectorAll(".role-item");

    roleItems.forEach(item => {
        item.addEventListener("click", () => {
            roleItems.forEach(i => i.classList.remove("active"));
            item.classList.add("active");

            const role = item.dataset.role;
            localStorage.setItem("selectedRole", role);
        });
    });



    /* =======================
       NAVBAR AUTH STATE
    ======================= */
    const isLogin  = localStorage.getItem("isLogin");
    const username = localStorage.getItem("username");
    const navAuth  = document.getElementById("navAuth");

    if (isLogin && username && navAuth) {
        navAuth.innerHTML = `
            <div class="user-name">
                Hi, ${username}
            </div>
        `;
    }


    /*=================
    SIDE BAR LOGIC
    ===================*/
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
    }
});
    /*=================
    Nav BAR HAM
    ===================*/
    document.addEventListener('DOMContentLoaded', () => {
        const navToggle = document.getElementById('navToggle');
        const navMenu   = document.getElementById('navMenu');

        if (navToggle && navMenu) {
            navToggle.addEventListener('click', () => {
                navMenu.classList.toggle('active');
            });
        }
    });


