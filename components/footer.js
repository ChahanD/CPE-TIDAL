export class Footer {
    constructor() {
        this.element = document.createElement('div');

        const isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        const navbarColor = isDarkMode ? 'navbar-dark bg-dark' : 'navbar-light bg-light';

        this.element.innerHTML = `
            <nav id="footer" class="navbar navbar-expand ${navbarColor} mt-3">
                <div class="collapse navbar-collapse d-flex justify-content-center item-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active text-white">
                            <p>2024 - Tous droits réservés</p>
                        </li>
            
                        <li class="nav-item active text-white ps-3">
                            <p>site réalisé par : <a href="https://github.com/UrocyonF" class="text-white">Moi</a></p>
                        </li>
                    </ul>
                </div>
            </nav>
        `;
    }

    attachTo(root) {
        root.appendChild(this.element);
    }
}
