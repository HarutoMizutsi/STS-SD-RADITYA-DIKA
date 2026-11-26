document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("menu-toggle");
    const navContainer = document.querySelector(".nav-container");

    if (!toggle || !navContainer) {
        return;
    }

    toggle.addEventListener("click", function () {
        const isOpen = navContainer.classList.toggle("is-open");
        toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });

    navContainer.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function () {
            navContainer.classList.remove("is-open");
            toggle.setAttribute("aria-expanded", "false");
        });
    });
});
