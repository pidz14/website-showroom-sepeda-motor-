(function () {
    const pageLinks = document.querySelectorAll("[data-page-link]");
    const pages = document.querySelectorAll("[data-page]");

    function showPage(pageName) {
        pages.forEach(function (page) {
            page.classList.toggle("page-shell--active", page.dataset.page === pageName);
        });

        pageLinks.forEach(function (link) {
            link.classList.toggle("is-active", link.dataset.pageLink === pageName);
        });

        if (window.location.hash !== "#" + pageName) {
            window.history.replaceState(null, "", "#" + pageName);
        }

        window.scrollTo({ top: 0, behavior: "smooth" });
    }

    pageLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            showPage(link.dataset.pageLink);
        });
    });

    window.addEventListener("hashchange", function () {
        const pageName = window.location.hash.replace("#", "");
        const validPage = document.querySelector('[data-page="' + pageName + '"]');

        if (validPage) {
            showPage(pageName);
        }
    });

    const initialPage = window.location.hash.replace("#", "");
    const validPage = document.querySelector('[data-page="' + initialPage + '"]');
    showPage(validPage ? initialPage : "landing");
})();
