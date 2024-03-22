import { Navbar } from '../components/navbar.js';
import { Footer } from '../components/footer.js';

const currentPage = window.location.pathname.split('/').pop().replace('.html', '');

const navbar = new Navbar(currentPage);
document.body.prepend(navbar.element);

const footer = new Footer();
document.body.appendChild(footer.element);
