import { createApp } from 'vue';
import mapsearch from '../components/mapSearch.vue';
import i18n from "../config/i18n";
// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', () => {
    const element = document.getElementById('map-search');
    
    if (element) {
        const app = createApp(mapsearch);
        app.use(i18n).mount('#map-search');
    }
});