    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const navLinks = document.querySelector('.links');
        const bg = document.querySelector('header');
        const body = document.body;

        menuToggle.addEventListener('click', function() {
            bg.classList.toggle('active');
            navLinks.classList.toggle('active');
            body.classList.toggle('show-sidebar');
        });
    });
