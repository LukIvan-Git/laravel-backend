<!-- resources/js/components/ExampleComponent.vue -->
<template>
    <div class="example-component">
        <h1>{{ title }}</h1>
        <p>Counter: {{ count }}</p>
        <button @click="increment">Increment</button>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    title: {
        type: String,
        default: 'Vue Component in Laravel'
    }
});

const count = ref(0);
const increment = () => {
    count.value++;
};
</script>

<style scoped>
.example-component {
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin: 10px 0;
}
</style>