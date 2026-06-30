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

    if (lightboxLinks.length > 0 && lightbox) {
        lightboxLinks.forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const src = link.getAttribute('data-lightbox');
                const alt = link.getAttribute('data-alt') || '';
                if (lightboxImg) {
                    lightboxImg.src = src;
                    lightboxImg.alt = alt;
                }
                lightbox.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (lightboxClose) {
            lightboxClose.addEventListener('click', closeLightbox);
        }

        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox || e.target.classList.contains('lightbox-overlay')) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                closeLightbox();
            }
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
