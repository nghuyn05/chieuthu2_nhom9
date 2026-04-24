console.log("JS loaded");

// ================= YEAR =================
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();

    var yearEl = document.querySelector("#displayYear");
    if (yearEl) {
        yearEl.innerHTML = currentYear;
    }
}
getYear();


// ================= OWL CAROUSEL =================
if (typeof $ !== "undefined" && $(".client_owl-carousel").length) {
    $(".client_owl-carousel").owlCarousel({
        loop: true,
        margin: 0,
        dots: false,
        nav: true,
        autoplay: true,
        autoplayHoverPause: true,
        navText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>'
        ],
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            1000: { items: 2 }
        }
    });
}


// ================= GOOGLE MAP =================
function myMap() {
    var mapEl = document.getElementById("googleMap");
    if (!mapEl) return;

    var mapProp = {
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };

    new google.maps.Map(mapEl, mapProp);
}


// ================= SEARCH =================

document.addEventListener("DOMContentLoaded", function () {

    const input = document.querySelector("#search-input");
    const resultBox = document.querySelector("#search-result");

    if (!input || !resultBox) return;

    let timeout = null;

    input.addEventListener("keyup", function (e) {

        let keyword = this.value.trim();

        // ENTER → chuyển trang
        if (e.key === "Enter") {
            if (!keyword) return;
            window.location.href = `/product?keyword=${encodeURIComponent(keyword)}`;
            return;
        }

        // rỗng → clear
        if (!keyword) {
            resultBox.innerHTML = "";
            resultBox.style.display = "none";
            return;
        }

        clearTimeout(timeout);

        timeout = setTimeout(() => {
            fetch(`/api/search?keyword=${encodeURIComponent(keyword)}`)
                .then(res => res.json())
                .then(data => {

                    if (!data || data.length === 0) {
                        resultBox.innerHTML = `<div style="padding:8px;">Không tìm thấy</div>`;
                    } else {
                        resultBox.innerHTML = data.map(item => `
                            <a href="/product/${item.id}" class="search-item">
                                ${item.name}
                            </a>
                        `).join("");
                    }

                    resultBox.style.display = "block";
                })
                .catch(err => console.error("Search error:", err));
        }, 300);
    });

    // click ngoài → ẩn dropdown
    document.addEventListener("click", function (e) {
        if (!input.contains(e.target) && !resultBox.contains(e.target)) {
            resultBox.style.display = "none";
        }
    });

});