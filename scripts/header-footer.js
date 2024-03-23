import { Navbar } from '../components/navbar.js';
import { Footer } from '../components/footer.js';


$(document).ready(function() {
    const currentPage = window.location.pathname.split('/').pop().replace('.html', '');

    const navbar = new Navbar(currentPage);
    document.body.prepend(navbar.element);

    const footer = new Footer();
    document.body.appendChild(footer.element);

    var navbarHeight = $('#navbar').outerHeight(true);
    var footerHeight = $('#footer').outerHeight(true);

    $('.container').css('min-height', `calc(100vh - ${navbarHeight}px - ${footerHeight}px)`);
});
