import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// 🔶 Importação necessária para ativar menus, dropdowns e componentes Flowbite
import 'flowbite';
// TEMA DARK/LIGHT
const themeToggle = document.getElementById('themeToggle');

if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        const html = document.documentElement;
        html.classList.toggle('dark');
        localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
    });

    // Carregar preferência
    if (localStorage.getItem('theme') === 'light') {
        document.documentElement.classList.remove('dark');
    }
}
