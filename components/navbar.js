export class Navbar {
    constructor(currentPage) {
        this.element = document.createElement('div');

        const isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        const navbarColor = isDarkMode ? 'navbar-dark bg-dark' : 'navbar-light bg-light';

        const adaptLinkToPage = currentPage == 'index' ? './pages/' : './';
        const adaptLinkToIndex = currentPage == 'index' ? './' : '../';

        this.element.innerHTML = `
            <nav class="navbar navbar-expand ${navbarColor}">
                <a class="navbar-brand ps-3" href="${adaptLinkToIndex}index.html">
                    <img src="../ressources/images/logo.webp" width="30" height="30" class="d-inline-block align-top" alt=""/>
                </a>

                <div class="collapse navbar-collapse d-flex" id="navbarNav">
                    <ul class="navbar-nav">
                        ${currentPage !== 'index' ? `
                            <li class="nav-item active">
                                <a class="nav-link" href="${adaptLinkToIndex}index.html">Accueil</a>
                            </li>
                        ` : ''}

                        ${currentPage !== 'patho' ? `
                            <li class="nav-item active">
                                <a class="nav-link" href="${adaptLinkToPage}patho.html">Pathologies</a>
                            </li>
                        ` : ''}

                        ${currentPage !== 'sympto' ? `
                            <li class="nav-item active">
                                <a class="nav-link" href="${adaptLinkToPage}sympto.html">Symptômes</a>
                            </li>
                        ` : ''}
                        </ul>

                    ${currentPage !== 'profil' ? `
                        <ul class="navbar-nav ms-auto pe-3">
                            <li class="nav-item active">
                                <a class="nav-link" href="${adaptLinkToPage}profil.html">Profil</a>
                            </li>
                        </ul>
                    ` : ''}
                </div>
            </nav>
        `;
    }

    attachTo(root) {
        root.appendChild(this.element);
    }
}