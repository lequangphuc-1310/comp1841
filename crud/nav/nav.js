const activePage = window.location.pathname;
const navLinks = document.querySelectorAll('.nav-child').forEach(
    link => {
        if (link.querySelector('a').href.includes(`${activePage}`)) {
            link.classList.add('active');
        }
    }
)