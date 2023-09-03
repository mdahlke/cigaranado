<script setup>
import { ref } from 'vue';
import { onMounted } from 'vue';
import axios from 'axios';
import UserCigar from '@/Components/UserCigar.vue';

const cigars = ref([]);

onMounted(() => {
    // make a request to laravel api for cigars
    axios.get('/my/cigars', {
        // withCredentials: true,
    })
    .then(response => {
        console.log(response.data);
        cigars.value = response.data;
    })
    .catch(error => {
        console.log(error);
    });
});
</script>

<template>
    <h1>Your Cigars</h1>

    <div 
        class="user-cigars"
    >
        <UserCigar 
            v-for="cigar in cigars" 
            :key="cigar.id"
            :cigar="cigar"
        />

    </div>
</template>

<style scoped>
.user-cigars {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 4fr));
    gap: 1rem;
}
</style>
