// resources/js/pages/courseApplicationIndex.js
import { createApp } from 'vue';
import career from '../components/career.vue';

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', () => {
    const element = document.getElementById('carrer-index');
    
    if (element) {
        const app = createApp(career);
        app.mount('#carrer-index');
    }
});