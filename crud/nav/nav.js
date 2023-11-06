const activePage = window.location.pathname;
const navLinks = document.querySelectorAll('.nav-child-container').forEach(
    link => {
        if (link.querySelector('a').href.includes(`${activePage}`)) {
            link.classList.add('active');
        }
    }
)