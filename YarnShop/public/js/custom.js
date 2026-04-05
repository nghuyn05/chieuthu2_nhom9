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

    // Không có input thì bỏ
    if (!input || !resultBox) {
        console.log("Search elements not found");
        return;
    }

    console.log("Search ready");

    // ================= GÕ =================
    input.addEventListener("keyup", function (e) {

        let keyword = this.value.trim();

        // ===== ENTER → chuyển trang =====
        if (e.key === "Enter") {
            if (!keyword) return;

            window.location.href = `/product?keyword=${encodeURIComponent(keyword)}`;
            return;
        }

        // ===== RỖNG → clear =====
        if (!keyword) {
            resultBox.innerHTML = "";
            return;
        }

        // ===== GỌI API =====
        fetch(`/api/search?keyword=${encodeURIComponent(keyword)}`)
            .then(res => res.json())
            .then(data => {

                let html = "";

                if (!data || data.length === 0) {
                    html = `<div style="padding:8px;">Không tìm thấy</div>`;
                } else {
                    data.forEach(product => {
                        html += `
                            <div style="
                                padding:8px;
                                border-bottom:1px solid #eee;
                                cursor:pointer;
                            ">
                                ${product.name}
                            </div>
                        `;
                    });
                }

                resultBox.style.display = "block";
                resultBox.innerHTML = data.map(item => `
                    <a href="/product/${item.id}" class="search-item">${item.name}
                    </a>
                    `).join("");
            })
            .catch(err => {
                console.error("Search error:", err);
            });
    });

});