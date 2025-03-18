let currentIndex = 0;
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot"); // Now, five dots
const prevBtn = document.querySelector(".prev"); // Left arrow button
const nextBtn = document.querySelector(".next"); // Right arrow button

// Change slide function
function changeSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove("active");
        if (dots[i]) dots[i].classList.remove("active"); // Only remove active from dots if they exist
    });

    slides[index].classList.add("active");
    if (dots[index]) dots[index].classList.add("active");
    currentIndex = index;
}

// Auto Slide Every 4 Seconds
function autoSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    changeSlide(currentIndex);
}

setInterval(autoSlide, 4000);

// Manual Slide Navigation with Arrow Buttons
function prevSlide() {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    changeSlide(currentIndex);
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    changeSlide(currentIndex);
}

// Event Listeners for Arrows
if (prevBtn) prevBtn.addEventListener("click", prevSlide);
if (nextBtn) nextBtn.addEventListener("click", nextSlide);

// Event Listeners for Dots
dots.forEach((dot, index) => {
    dot.addEventListener("click", () => changeSlide(index));
});

// Ensure page animations and interactions remain unchanged
document.addEventListener("DOMContentLoaded", function () {
    const showcase = document.querySelector(".event-showcase");

    function handleScroll() {
        const rect = showcase.getBoundingClientRect();
        if (rect.top < window.innerHeight - 50) {
            showcase.classList.add("show");
        }
    }

    window.addEventListener("scroll", handleScroll);
    handleScroll(); // Run once on page load
});

// Register Button Navigation
document.querySelectorAll('.register-btn').forEach(button => {
    button.addEventListener('click', function () {
        const eventName = this.previousElementSibling.textContent;
        window.location.href = `register.html?event=${encodeURIComponent(eventName)}`;
    });
});

// Scroll-triggered Animations for Sections
document.addEventListener("scroll", function () {
    const sections = [
        { id: "collegeSection", class: "show-college-info" },
        { id: "locationSection", class: "show-location-info" },
        { id: "facultySection", class: "show-faculty" },
        { id: "aboutSection", class: "about-visible" }
    ];

    sections.forEach(section => {
        const elem = document.getElementById(section.id);
        if (elem) {
            const position = elem.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;
            if (position < screenPosition) {
                elem.classList.add(section.class);
            }
        }
    });
});


// Mobile Menu Toggle
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector(".nav-links");

    if (menuToggle && navLinks) {
        menuToggle.addEventListener("click", function () {
            navLinks.classList.toggle("show");
        });
    }
});


document.addEventListener("DOMContentLoaded", function() {
    // Scroll Animation for Event Showcase Section
    const showcase = document.querySelector(".event-showcase");
    function handleShowcaseScroll() {
        const rect = showcase.getBoundingClientRect();
        if (rect.top < window.innerHeight - 50) {
            showcase.classList.add("show");
        }
    }
    window.addEventListener("scroll", handleShowcaseScroll);
    handleShowcaseScroll(); // Run once on page load

    // Register Button Click Event
    document.querySelectorAll('.register-btn').forEach(button => {
        button.addEventListener('click', function () {
            const eventName = this.previousElementSibling.textContent;
            window.location.href = `register.html?event=${encodeURIComponent(eventName)}`;
        });
    });

    // Scroll Animation for College Section
    function revealCollegeOnScroll() {
        const collegeSection = document.getElementById("collegeSection");
        const position = collegeSection.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.3;

        if (position < screenPosition) {
            collegeSection.classList.add("show-college-info");
        }
    }
    
    // Scroll Animation for Location Section
    function revealLocationOnScroll() {
        const locationSection = document.getElementById("locationSection");
        const position = locationSection.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.3;

        if (position < screenPosition) {
            locationSection.classList.add("show-location-info");
        }
    }
    
    // Scroll Animation for Faculty Section
    function revealFacultyOnScroll() {
        const facultySection = document.getElementById("facultySection");
        if (facultySection) {
            const position = facultySection.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;

            if (position < screenPosition) {
                facultySection.classList.add("show-faculty");
            }
        }
    }

    // Scroll Animation for About Section
    function revealAboutOnScroll() {
        const aboutSection = document.querySelector(".about-section");
        if (aboutSection) {
            const position = aboutSection.getBoundingClientRect().top;
            const screenHeight = window.innerHeight;

            if (position < screenHeight - 100) {
                aboutSection.classList.add("about-visible");
            }
        }
    }

    // Menu Toggle for Mobile
    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector(".nav-links");
    if (menuToggle && navLinks) {
        menuToggle.addEventListener("click", function () {
            navLinks.classList.toggle("show");
        });
    }

    // Run Scroll Event Listeners
    function handleScroll() {
        revealCollegeOnScroll();
        revealLocationOnScroll();
        revealFacultyOnScroll();
        revealAboutOnScroll();
    }

    window.addEventListener("scroll", handleScroll);
    handleScroll(); // Initial Check when the page loads
});

//for online events effects//
document.addEventListener("scroll", function () {
    const featuredEvents = document.querySelector(".featured-events");
    if (featuredEvents) {
        const position = featuredEvents.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.3;

        if (position < screenPosition) {
            featuredEvents.classList.add("show");
        }
    }
});
// Select the menu toggle and navigation links
const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');

// Add event listener to the menu toggle to handle click
menuToggle.addEventListener('click', function() {
    // Toggle the 'show' class to display/hide the menu
    navLinks.classList.toggle('show');
});
//slide for industry 
document.addEventListener("DOMContentLoaded", function () {
    const container = document.querySelector(".partners-container");
    const copy = container.innerHTML; // Duplicate logos for infinite scrolling
    container.innerHTML += copy; // Append copy to create a seamless effect
});
