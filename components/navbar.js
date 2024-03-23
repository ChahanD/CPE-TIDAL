export class Navbar {
    constructor(currentPage) {
        this.element = document.createElement('div');

        const isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        const navbarColor = isDarkMode ? 'navbar-dark bg-dark' : 'navbar-light bg-light';

        this.element.innerHTML = `
            <nav id="navbar" class="navbar navbar-expand ${navbarColor}">
                <a class="navbar-brand ps-3" href="./index.html">
                    <img src="../ressources/images/logo.webp" width="30" height="30" class="d-inline-block align-top" alt=""/>
                </a>

                <div class="collapse navbar-collapse d-flex" id="navbarNav">
                    <ul class="navbar-nav">
                        ${currentPage !== 'index' ? `
                            <li class="nav-item active">
                                <a class="nav-link" href="./index.html">Accueil</a>
                            </li>
                        ` : ''}

                        ${currentPage !== 'patho' ? `
                            <li class="nav-item active">
                                <a class="nav-link" href="./patho.html">Pathologies</a>
                            </li>
                        ` : ''}

                        ${currentPage !== 'sympto' ? `
                            <li class="nav-item active">
                                <a class="nav-link" href="./sympto.html">Symptômes</a>
                            </li>
                        ` : ''}
                        </ul>

                    ${currentPage !== 'authentication' ? `
                        <ul class="navbar-nav ms-auto pe-3">
                            <li class="nav-item active">
                                <a class="nav-link" href="./authentication.html">Authentification</a>
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
