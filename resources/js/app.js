import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// 🔶 Flowbite (menus, dropdowns, modal, etc)
import 'flowbite';

/*
|--------------------------------------------------------------------------
| 🌗 Tema Dark/Light — PRONTO E FUNCIONANDO
|--------------------------------------------------------------------------
|
| Este script:
| ✔ Carrega o tema salvo no localStorage antes de iniciar
| ✔ Alterna corretamente entre dark/light
| ✔ Mantém o estado ao recarregar
| ✔ Evita "flash" (tela piscando ao carregar a página)
|
*/

// Carregar tema salvo (executa no início)
(function initializeTheme() {
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
    } else if (savedTheme === 'light') {
        document.documentElement.classList.remove('dark');
    } else {
        // Se não houver preferência salva, usa o sistema operacional
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
})();

// Ativar botão de troca de tema
document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('themeToggle');

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');

            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    }
});
