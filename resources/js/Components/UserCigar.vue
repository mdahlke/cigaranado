<script setup>
import { defineProps } from 'vue'

const props = defineProps({
    userCigar: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <v-card class="user-cigar"
        :title="props.userCigar.cigar.name"
        :subtitle="props.userCigar.cigar.brand.manufacturer.name"
        :text="'Rating: ' + props.userCigar.rating.toString()" 
    />
</template>

<style scoped>
/* .user-cigar {
    display: grid;
    background: #fff;
    padding: 1rem;
    border-radius: 5px;
} */
</style>