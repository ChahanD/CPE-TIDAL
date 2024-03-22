export class Navbar {
    constructor(currentPage) {
        this.element = document.createElement('div');
        this.element.innerHTML = `
            <nav class="navbar navbar-expand navbar-dark bg-dark">
                <a class="navbar-brand ps-3" href="index.html">
                    <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt=""/>
                </a>

                <div class="collapse navbar-collapse d-flex" id="navbarNav">
                    <ul class="navbar-nav">
                        ${currentPage !== 'patho' ? `
                            <li class="nav-item active">
                                <a class="nav-link" href="patho.html">Pathologies</a>
                            </li>
                        ` : ''}

                        ${currentPage !== 'sympto' ? `
                            <li class="nav-item active">
                                <a class="nav-link" href="sympto.html">Symptômes</a>
                            </li>
                        ` : ''}
                        </ul>

                    ${currentPage !== 'profil' ? `
                        <ul class="navbar-nav ms-auto pe-3">
                            <li class="nav-item active">
                                <a class="nav-link" href="profil.html">Profil</a>
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