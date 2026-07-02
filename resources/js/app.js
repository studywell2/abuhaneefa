import './bootstrap';

// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function () {
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function () {
            navMenu.classList.toggle('hidden');
            // Animate hamburger icon
            const icon = navToggle.querySelector('svg');
            if (icon) {
                navToggle.classList.toggle('active');
            }
        });

        // Close menu on link click (mobile)
        navMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth < 1024) {
                    navMenu.classList.add('hidden');
                }
            });
        });
    }

    // Scroll reveal using Intersection Observer
    const revealElements = document.querySelectorAll('.reveal');

    if (revealElements.length > 0) {
        const observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15, rootMargin: '0px 0px -50px 0px' }
        );

        revealElements.forEach(function (el) {
            observer.observe(el);
        });
    }

    // Lightbox functionality
    const lightboxLinks = document.querySelectorAll('[data-lightbox]');
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');
    const lightboxCounter = document.getElementById('lightbox-counter');

    if (lightboxLinks.length > 0 && lightbox) {
        const items = Array.from(lightboxLinks).map(function (link) {
            return {
                src: link.getAttribute('data-lightbox'),
                alt: link.getAttribute('data-alt') || '',
            };
        });
        let currentIndex = 0;

        function showImage(index) {
            currentIndex = (index + items.length) % items.length;
            if (lightboxImg) {
                lightboxImg.src = items[currentIndex].src;
                lightboxImg.alt = items[currentIndex].alt;
            }
            if (lightboxCounter) {
                lightboxCounter.textContent = (currentIndex + 1) + ' of ' + items.length;
            }
        }

        lightboxLinks.forEach(function (link, index) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                showImage(index);
                lightbox.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }

        function prevImage() {
            showImage(currentIndex - 1);
        }

        function nextImage() {
            showImage(currentIndex + 1);
        }

        if (lightboxClose) {
            lightboxClose.addEventListener('click', closeLightbox);
        }

        if (lightboxPrev) {
            lightboxPrev.addEventListener('click', function (e) {
                e.stopPropagation();
                prevImage();
            });
        }

        if (lightboxNext) {
            lightboxNext.addEventListener('click', function (e) {
                e.stopPropagation();
                nextImage();
            });
        }

        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox || e.target.classList.contains('lightbox-overlay')) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (!lightbox.classList.contains('active')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') prevImage();
            if (e.key === 'ArrowRight') nextImage();
        });
    }

    // Navbar shadow on scroll
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-lg', 'bg-white/95');
                navbar.classList.remove('bg-transparent');
            } else {
                navbar.classList.remove('shadow-lg', 'bg-white/95');
                navbar.classList.add('bg-transparent');
            }
        });
    }
});
