
    // Preloader Removal
    document.addEventListener('DOMContentLoaded', () => {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            window.addEventListener('load', () => {
                preloader.remove();
            });
        }
    });

    // Header Scroll Effect
    document.addEventListener('scroll', () => {
        const header = document.getElementById('header');
        const scrollPosition = window.scrollY;
        const viewportHeight = window.innerHeight / 2;

        if (scrollPosition > viewportHeight) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    });

    // Menu Toggle Function
    function toggle() {
        const aside = document.getElementById('aside');
        if (aside.style.height === '100%') {
            aside.style.height = '0';
        } else {
            aside.style.height = '100%';
        }
    }


