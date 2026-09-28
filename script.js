// script.js
// Custom Interactions for Sama College Website

document.addEventListener('DOMContentLoaded', () => {

    // 1. Live Clock and Date functionality
    function updateClock() {
        const clockElement = document.getElementById('liveClock');
        const dateElement = document.getElementById('liveDate');
        if (!clockElement && !dateElement) return;

        const now = new Date();

        // Update Clock
        if (clockElement) {
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();
            let ampm = hours >= 12 ? 'م' : 'ص';

            hours = hours % 12;
            hours = hours ? hours : 12;
            
            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            const timeString = `${hours}:${minutes}:${seconds} ${ampm}`;
            clockElement.textContent = timeString;
        }

        // Update Date
        if (dateElement) {
            const dayNameOptions = { weekday: 'long' };
            const dayName = now.toLocaleDateString('ar-YE', dayNameOptions);
            
            const dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
            const dateParts = now.toLocaleDateString('ar-YE-u-nu-latn', dateOptions);
            
            const dateString = `${dayName} | ${dateParts} م`;
            dateElement.textContent = dateString;
        }
    }
    
    // Initialize clock and update every second
    updateClock();
    setInterval(updateClock, 1000);

    // 2. Mobile Menu Toggle
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // 3. Scroll Reveal Animation for elements with class 'reveal'
    function revealElement() {
        const reveals = document.querySelectorAll('.reveal');
        for (let i = 0; i < reveals.length; i++) {
            const windowHeight = window.innerHeight;
            const elementTop = reveals[i].getBoundingClientRect().top;
            const elementVisible = 100;

            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add('active');
            }
        }
    }
    window.addEventListener('scroll', revealElement);
    // trigger once on load
    revealElement();

    // 4. Statistics Number Counter Animation
    const counters = document.querySelectorAll('.counter');
    const speed = 100; // lower is slower

    // Intersection Observer to trigger counting when element is in view
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = +counter.getAttribute('data-target');
                
                const updateCount = () => {
                    const count = +counter.innerText;
                    const inc = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc);
                        setTimeout(updateCount, 20);
                    } else {
                        counter.innerText = target;
                    }
                };

                updateCount();
                observer.unobserve(counter); // only animate once
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => {
        observer.observe(counter);
    });

    // 5. Simple Slider functionality for Hero section
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slide-dot');
    
    // Data for text changes
    const titles = [
        "نمنحك المهارة..<br><span class='text-gold'>هنا يصبح الحلم حقيقة</span>",
        "بيئة تعليمية محفزة..<br><span class='text-gold'>وكادر تدريسي مؤهل</span>"
    ];
    const descs = [
        "انضم إلى أول صرح أكاديمي متميز يجمع بين العلوم الطبية الحديثة، والتقنيات الهندسية المتقدمة لتهيئة جيل قائد قادر على مواكبة العصر.",
        "تمتلك الكلية أحدث المعامل الطبية والتقنية التي توفر للطالب البيئة المثالية للتطبيق العملي والاستعداد التام لسوق العمل المحلي والإقليمي."
    ];

    window.changeSlide = function(index) {
        if (!slides.length) return;
        
        currentSlide = index;

        // Reset all slides opacity
        slides.forEach(slide => slide.classList.replace('opacity-100', 'opacity-0'));
        dots.forEach(dot => {
            dot.classList.remove('active-dot', 'w-10');
            dot.classList.add('w-4', 'opacity-50');
        });

        // Show active slide
        slides[currentSlide].classList.replace('opacity-0', 'opacity-100');
        dots[currentSlide].classList.add('active-dot', 'w-10');
        dots[currentSlide].classList.remove('w-4', 'opacity-50');

        // Update Text
        const titleEl = document.getElementById('heroTitle');
        const descEl = document.getElementById('heroDesc');
        if(titleEl && descEl) {
            // Re-trigger animation
            titleEl.classList.remove('animate-fade-up');
            descEl.classList.remove('animate-fade-up');
            
            // force reflow
            void titleEl.offsetWidth; 
            
            titleEl.innerHTML = titles[currentSlide];
            descEl.innerHTML = descs[currentSlide];
            
            titleEl.classList.add('animate-fade-up');
            descEl.classList.add('animate-fade-up');
        }
    };

    // Auto rotate slides every 8 seconds
    setInterval(() => {
        if(slides.length > 0) {
            let nextSlide = (currentSlide + 1) % slides.length;
            changeSlide(nextSlide);
        }
    }, 8000);

    // 6. Sticky Navbar style change on scroll
    const navbar = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        if(window.scrollY > 50) {
            navbar.classList.add('py-1');
            navbar.classList.remove('py-3');
        } else {
            navbar.classList.add('py-3');
            navbar.classList.remove('py-1');
        }
    });
});