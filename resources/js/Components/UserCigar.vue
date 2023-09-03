<script setup>
import { defineProps } from 'vue'

const props = defineProps({
    cigar: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <div class="user-cigar">
        <h1>{{ props.cigar.name }}</h1>
        <p>{{ props.cigar.pivot.rating }}</p>
    </div>
</template>

<style scoped>
.user-cigar {
    display: grid;
    background: #fff;
    padding: 1rem;
    border-radius: 5px;
}
</style>