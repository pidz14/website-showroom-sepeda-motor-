(function () {
    const API_BASE_URL = window.SHOWROOM_API_BASE_URL || "";
    const fallbackImage = "https://commons.wikimedia.org/wiki/Special:Redirect/file/2022%20Honda%20PCX%20160%20Gray%20Black.jpg";
    const pageLinks = document.querySelectorAll("[data-page-link]");
    const pages = document.querySelectorAll("[data-page]");
    const featuredGrid = document.querySelector("[data-featured-grid]");
    const catalogGrid = document.querySelector("[data-catalog-grid]");
    const catalogStatus = document.querySelector("[data-catalog-status]");
    const brandFilter = document.querySelector("[data-filter-brand]");
    const priceFilter = document.querySelector("[data-filter-price]");
    const availableFilter = document.querySelector("[data-filter-available]");
    const searchInput = document.querySelector("[data-search-input]");
    const detail = {
        image: document.querySelector("[data-detail-image]"),
        title: document.querySelector("[data-detail-title]"),
        price: document.querySelector("[data-detail-price]"),
        state: document.querySelector("[data-detail-state]"),
        year: document.querySelector("[data-detail-year]"),
        type: document.querySelector("[data-detail-type]"),
        status: document.querySelector("[data-detail-status]"),
        description: document.querySelector("[data-detail-description]"),
        brand: document.querySelector("[data-detail-brand]"),
        stock: document.querySelector("[data-detail-stock]"),
        priceTable: document.querySelector("[data-detail-price-table]"),
    };
    let motors = [];

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

    function apiUrl(path) {
        return API_BASE_URL.replace(/\/$/, "") + path;
    }

    function formatCurrency(value, fallback) {
        const numericValue = Number(value);

        if (!Number.isFinite(numericValue)) {
            return fallback || "-";
        }

        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            maximumFractionDigits: 0,
        }).format(numericValue);
    }

    function getBrandName(motor) {
        if (!motor) {
            return "-";
        }

        if (typeof motor.merek === "string") {
            return motor.merek;
        }

        return motor.merek && motor.merek.nama_merek ? motor.merek.nama_merek : "-";
    }

    function getMotorName(motor) {
        return motor.nama_motor || motor.nama || motor.name || "Motor showroom";
    }

    function getMotorImage(motor) {
        return motor.gambar || motor.image || fallbackImage;
    }

    function getMotorPrice(motor) {
        return motor.harga_format || formatCurrency(motor.harga);
    }

    function getStatusLabel(status) {
        if (status === "tersedia") {
            return "Tersedia";
        }

        if (status === "indent") {
            return "Indent";
        }

        if (status === "habis") {
            return "Habis";
        }

        return status || "-";
    }

    function createStatusBadge(status) {
        const badge = document.createElement("span");
        badge.className = status === "tersedia" ? "status status--ready" : "status status--limited";
        badge.textContent = getStatusLabel(status);
        return badge;
    }

    function createStateMessage(message, type) {
        const element = document.createElement("div");
        element.className = "state-message" + (type ? " state-message--" + type : "");
        element.textContent = message;
        return element;
    }

    function normalizeMotorsResponse(payload) {
        if (Array.isArray(payload)) {
            return payload;
        }

        if (payload && payload.data && Array.isArray(payload.data.motors)) {
            return payload.data.motors;
        }

        if (payload && Array.isArray(payload.motors)) {
            return payload.motors;
        }

        return [];
    }

    function normalizeMotorResponse(payload) {
        if (payload && payload.data && !Array.isArray(payload.data)) {
            return payload.data;
        }

        return payload || {};
    }

    async function fetchJson(path) {
        const response = await fetch(apiUrl(path), {
            headers: {
                Accept: "application/json",
            },
        });

        if (!response.ok) {
            throw new Error("API mengembalikan status " + response.status);
        }

        return response.json();
    }

    function createMotorCard(motor, headingTag) {
        const article = document.createElement("article");
        article.className = headingTag === "h3" ? "motor-card" : "motor-card motor-card--catalog";

        const image = document.createElement("img");
        image.src = getMotorImage(motor);
        image.alt = getMotorName(motor);

        const body = document.createElement("div");
        body.className = "motor-card__body";
        body.appendChild(createStatusBadge(motor.status));

        const title = document.createElement(headingTag);
        title.textContent = getMotorName(motor);
        body.appendChild(title);

        const meta = document.createElement("div");
        meta.className = "motor-card__meta";
        meta.textContent = [getBrandName(motor), motor.tahun, motor.tipe].filter(Boolean).join(" / ");
        body.appendChild(meta);

        const price = document.createElement("p");
        price.textContent = getMotorPrice(motor);
        body.appendChild(price);

        if (headingTag !== "h3") {
            const button = document.createElement("button");
            button.className = "ghost-button";
            button.type = "button";
            button.dataset.motorDetail = motor.id;
            button.textContent = "Lihat Detail";
            body.appendChild(button);
        }

        article.appendChild(image);
        article.appendChild(body);

        return article;
    }

    function getFilteredMotors() {
        const selectedBrand = brandFilter ? brandFilter.value : "";
        const selectedPrice = priceFilter ? priceFilter.value : "";
        const onlyAvailable = availableFilter ? availableFilter.checked : false;
        const keyword = searchInput ? searchInput.value.trim().toLowerCase() : "";

        return motors.filter(function (motor) {
            const brandName = getBrandName(motor);
            const price = Number(motor.harga || 0);
            const searchableText = [getMotorName(motor), brandName, motor.tipe, motor.tahun].join(" ").toLowerCase();

            if (selectedBrand && brandName !== selectedBrand) {
                return false;
            }

            if (selectedPrice === "under-30000000" && price >= 30000000) {
                return false;
            }

            if (selectedPrice === "over-30000000" && price < 30000000) {
                return false;
            }

            if (onlyAvailable && motor.status !== "tersedia") {
                return false;
            }

            return !keyword || searchableText.includes(keyword);
        });
    }

    function renderFeatured() {
        if (!featuredGrid) {
            return;
        }

        featuredGrid.replaceChildren();

        motors.slice(0, 3).forEach(function (motor) {
            featuredGrid.appendChild(createMotorCard(motor, "h3"));
        });

        if (!motors.length) {
            featuredGrid.appendChild(createStateMessage("Belum ada motor unggulan dari API.", "empty"));
        }
    }

    function renderCatalog() {
        if (!catalogGrid) {
            return;
        }

        const filteredMotors = getFilteredMotors();
        catalogGrid.replaceChildren();

        filteredMotors.forEach(function (motor) {
            catalogGrid.appendChild(createMotorCard(motor, "h2"));
        });

        if (catalogStatus) {
            catalogStatus.className = "catalog-status catalog-status--success";
            catalogStatus.textContent = filteredMotors.length + " motor ditampilkan dari " + motors.length + " data API.";
        }

        if (!filteredMotors.length) {
            catalogGrid.appendChild(createStateMessage("Tidak ada motor yang cocok dengan filter saat ini.", "empty"));
        }
    }

    function populateBrandFilter() {
        if (!brandFilter) {
            return;
        }

        const selectedValue = brandFilter.value;
        const brands = Array.from(new Set(motors.map(getBrandName).filter(function (brand) {
            return brand && brand !== "-";
        }))).sort();

        brandFilter.replaceChildren();

        const allOption = document.createElement("option");
        allOption.value = "";
        allOption.textContent = "Semua Merek";
        brandFilter.appendChild(allOption);

        brands.forEach(function (brand) {
            const option = document.createElement("option");
            option.value = brand;
            option.textContent = brand;
            brandFilter.appendChild(option);
        });

        brandFilter.value = brands.includes(selectedValue) ? selectedValue : "";
    }

    function renderDetail(motor, message, stateType) {
        if (!motor || !detail.title) {
            return;
        }

        const price = getMotorPrice(motor);
        detail.image.src = getMotorImage(motor);
        detail.image.alt = "Foto " + getMotorName(motor);
        detail.title.textContent = getMotorName(motor);
        detail.price.textContent = price;
        detail.year.textContent = motor.tahun || "-";
        detail.type.textContent = motor.tipe || "-";
        detail.status.replaceChildren(createStatusBadge(motor.status));
        detail.description.textContent = motor.deskripsi || "Deskripsi motor belum tersedia dari API.";
        detail.brand.textContent = getBrandName(motor);
        detail.stock.textContent = typeof motor.stok === "undefined" ? "-" : motor.stok + " unit";
        detail.priceTable.textContent = price;

        if (detail.state) {
            detail.state.className = "detail-state" + (stateType ? " detail-state--" + stateType : "");
            detail.state.textContent = message || "Detail motor berhasil dimuat dari API.";
        }
    }

    async function loadDetail(motorId) {
        const previewMotor = motors.find(function (motor) {
            return String(motor.id) === String(motorId);
        });

        if (previewMotor) {
            renderDetail(previewMotor, "Memuat detail terbaru dari API...", "loading");
        }

        showPage("detail");

        try {
            const payload = await fetchJson("/motors/" + motorId);
            renderDetail(normalizeMotorResponse(payload), "Detail motor berhasil dimuat dari API.", "success");
        } catch (error) {
            if (detail.state) {
                detail.state.className = "detail-state detail-state--error";
                detail.state.textContent = "Gagal memuat detail API. " + error.message;
            }
        }
    }

    async function loadCatalog() {
        if (catalogStatus) {
            catalogStatus.className = "catalog-status";
            catalogStatus.textContent = "Memuat katalog motor dari API...";
        }

        try {
            const payload = await fetchJson("/motors");
            motors = normalizeMotorsResponse(payload);
            populateBrandFilter();
            renderFeatured();
            renderCatalog();
        } catch (error) {
            if (catalogStatus) {
                catalogStatus.className = "catalog-status catalog-status--error";
                catalogStatus.textContent = "Gagal mengambil data katalog. " + error.message;
            }

            if (featuredGrid) {
                featuredGrid.replaceChildren(createStateMessage("Motor unggulan belum bisa dimuat dari API.", "error"));
            }

            if (catalogGrid) {
                catalogGrid.replaceChildren(createStateMessage("Pastikan backend berjalan dan endpoint /motors mengembalikan JSON.", "error"));
            }
        }
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

    [brandFilter, priceFilter, availableFilter, searchInput].forEach(function (input) {
        if (!input) {
            return;
        }

        input.addEventListener(input.type === "search" ? "input" : "change", renderCatalog);
    });

    document.addEventListener("click", function (event) {
        const detailButton = event.target.closest("[data-motor-detail]");

        if (detailButton) {
            loadDetail(detailButton.dataset.motorDetail);
        }
    });

    loadCatalog();
})();
