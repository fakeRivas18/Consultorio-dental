document.addEventListener('DOMContentLoaded', () => {
    
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    const dotsContainer = document.querySelector('.slider-dots');
    const sliderContainer = document.querySelector('.slider-container');

    
    if (!slides.length) return;

    let index = 0; 
    let autoSlideInterval = null;
    let resumeTimeout = null;
    const autoSlideDelay = 3000; 
    const resumeDelay = 5000; 


    if (dotsContainer) {
        dotsContainer.innerHTML = ''; 
        slides.forEach((_, i) => {
            const dot = document.createElement('span');
            if (i === 0) dot.classList.add('active');
            
            dot.addEventListener('click', () => {
                index = i;
                showSlide(index);
                stopAutoSlideTemporarily();
            });
            dotsContainer.appendChild(dot);
        });
    }

    const dots = document.querySelectorAll('.slider-dots span');

    
    function showSlide(i) {
        slides.forEach((slide, idx) => {
            slide.classList.toggle('active', idx === i);
        });
        dots.forEach((dot, idx) => {
            dot.classList.toggle('active', idx === i);
        });
    }

    function nextSlide() {
        index = (index + 1) % slides.length;
        showSlide(index);
    }

    function prevSlide() {
        index = (index - 1 + slides.length) % slides.length;
        showSlide(index);
    }


    function startAutoSlide() {
        stopAutoSlide(); 
        autoSlideInterval = setInterval(nextSlide, autoSlideDelay);
    }

    function stopAutoSlide() {
        if (autoSlideInterval) {
            clearInterval(autoSlideInterval);
            autoSlideInterval = null;
        }
    }

    function stopAutoSlideTemporarily() {
        stopAutoSlide();
        clearTimeout(resumeTimeout);
        resumeTimeout = setTimeout(startAutoSlide, resumeDelay);
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            prevSlide();
            stopAutoSlideTemporarily();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            nextSlide();
            stopAutoSlideTemporarily();
        });
    }

    if (sliderContainer) {
        let startX = 0;

        sliderContainer.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        }, { passive: true });

        sliderContainer.addEventListener('touchend', (e) => {
            let endX = e.changedTouches[0].clientX;
            if (startX - endX > 50) {
                nextSlide();
                stopAutoSlideTemporarily();
            } else if (endX - startX > 50) {
                prevSlide();
                stopAutoSlideTemporarily();
            }
        }, { passive: true });

        sliderContainer.addEventListener('mouseenter', stopAutoSlide);
        sliderContainer.addEventListener('mouseleave', startAutoSlide);
    }

    showSlide(index);
    startAutoSlide();
});