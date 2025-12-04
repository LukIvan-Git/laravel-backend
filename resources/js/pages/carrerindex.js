// resources/js/pages/courseApplicationIndex.js
import { createApp } from 'vue';
import example from '../components/example.vue';

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', () => {
    const element = document.getElementById('carrer-index');
    
    if (element) {
        const app = createApp(example);
        app.mount('#carrer-index');
    }
});