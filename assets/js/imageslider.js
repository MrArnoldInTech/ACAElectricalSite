document.addEventListener("DOMContentLoaded", function () {
    const header = document.getElementById("header-wrapper");

    const images = [
        "images/SolarPanel.jpg",
        "images/solar_otherpanel.jpg",
        "images/Solar-panels-installed.jpg"
    ];

    let current = 0;

    // --------- Create navigation dots dynamically ---------
    const dotsContainer = document.querySelector('.slider-dots');
    images.forEach((_, i) => {
        const dot = document.createElement('span');
        dot.className = i === 0 ? 'dot active' : 'dot';
        dot.dataset.slide = i;
        dotsContainer.appendChild(dot);
    });
    const dots = document.querySelectorAll('.dot');

    // --------- Preload first image ---------
    const firstImage = new Image();
    firstImage.src = images[0];
    firstImage.onload = function() {
        // Show first image only after loaded
        header.style.backgroundImage = `url('images/bg01.png'), url('${images[0]}')`;
        header.classList.add("fade");
    };

    // --------- Slider update function ---------
    function updateSlider(index) {
        current = index;
        header.classList.add("fade");

        header.style.backgroundImage =
            `url('images/bg01.png'), url('${images[current]}')`;

        // Update dots
        dots.forEach(dot => dot.classList.remove("active"));
        dots[current].classList.add("active");

        setTimeout(() => header.classList.remove("fade"), 1000);
    }

    // Auto-rotate
    setInterval(() => {
        current = (current + 1) % images.length;
        updateSlider(current);
    }, 5000);

    // Dot click navigation
    dots.forEach(dot => {
        dot.addEventListener("click", () => {
            updateSlider(parseInt(dot.dataset.slide));
        });
    });
});