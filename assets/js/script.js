document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("themeToggle");
    const body = document.body;

    // Charger le mode sauvegardé
    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark-mode");
        toggle.innerHTML = "☀️ Mode clair";
    }

    toggle.addEventListener("click", function () {
        body.classList.toggle("dark-mode");

        if (body.classList.contains("dark-mode")) {
            localStorage.setItem("theme", "dark");
            toggle.innerHTML = "☀️ Mode clair";
        } else {
            localStorage.setItem("theme", "light");
            toggle.innerHTML = "🌙 Mode sombre";
        }
    });
});
