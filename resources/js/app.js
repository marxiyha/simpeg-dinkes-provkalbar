import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/*
|--------------------------------------------------------------------------
| SIMPEG PETINGGI JS CORE
|--------------------------------------------------------------------------
*/

console.log('SIMPEG PETINGGI Loaded');

// OPTIONAL: helper global kalau nanti mau dipakai di dashboard
window.SIMPEG = {
    version: "1.0.0",

    // contoh fungsi global
    formatDate(date) {
        return new Date(date).toLocaleDateString('id-ID');
    },

    notify(message) {
        alert(message);
    }
};