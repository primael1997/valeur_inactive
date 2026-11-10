
function slideToggle(element, duration = 300) {
    if (!element) return;

    if (element.clientHeight === 0) {
        element.style.display = 'block';
    }

    element.classList.toggle('active');

    if (element.classList.contains('active')) {
        element.style.height = 'auto';
    } else {
        element.style.height = '0';
    }
}

// Initialisation du menu
function initMazer() {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar) return;

    // Sous-menus
    const sidebarItems = document.querySelectorAll('.sidebar-item.has-sub');

    sidebarItems.forEach((item) => {
        const link = item.querySelector('.sidebar-link');
        const submenu = item.querySelector('.submenu');

        if (!link || !submenu) return;

        link.addEventListener('click', (e) => {
            e.preventDefault();
            slideToggle(submenu);
        });
    });

    // Bouton d'ouverture
    const burger = document.querySelector('.burger-btn');

    if (burger) {
        burger.addEventListener('click', (e) => {
            e.preventDefault();
            sidebar.classList.toggle('active');
        });
    }

    // Bouton de fermeture
    const hide = document.querySelector('.sidebar-hide');

    if (hide) {
        hide.addEventListener('click', (e) => {
            e.preventDefault();
            sidebar.classList.remove('active');
        });
    }

    // Responsive
    if (window.innerWidth < 1200) {
        sidebar.classList.remove('active');
    } else {
        sidebar.classList.add('active');
    }

    // Scroll vers le menu actif
    const activeItem = document.querySelector('.sidebar-item.active');

    if (activeItem) {
        activeItem.scrollIntoView({ block: 'nearest' });
    }

    // Perfect Scrollbar
    const container = document.querySelector('.sidebar-wrapper');

    if (container && typeof PerfectScrollbar === 'function') {
        if (!container.dataset.psInitialized) {
            new PerfectScrollbar(container, {
                wheelPropagation: false,
            });

            container.dataset.psInitialized = 'true';
        }
    }
}

// Initialisation initiale
document.addEventListener('DOMContentLoaded', initMazer);

// Réinitialisation après navigation Inertia
document.addEventListener('inertia:navigate', initMazer);
