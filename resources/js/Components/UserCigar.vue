<script setup>
import { defineProps, computed } from 'vue'

const props = defineProps({
    userCigar: {
        type: Object,
        required: true,
    },
});

const image = computed(() => {
    console.log('cigar', props.userCigar);

    if(props.userCigar.thumbnail.length > 0){
        return props.userCigar.thumbnail
    }
    return '';
});

const rating = computed(() => {
    if(props.userCigar.rating){
        return parseFloat(props.userCigar.rating).toLocaleString();
    }

    return 'n/a';
})


</script>

<template>
    <v-card class="user-cigar">
        <v-img
            v-if="image"
            :src="image"
            class="align-end"
            gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
            height="200px"
            cover
        />

        <v-card-title>
            {{ props.userCigar.cigar_name }}
        </v-card-title>

        <v-card-subtitle>
            {{ props.userCigar.brand_name}} <small>({{ props.userCigar.manufacturer_name }})</small>
        </v-card-subtitle>

        <v-card-text>
            {{ 'Rating: ' + rating || 'n/a' }}
            <br />
            Smoked <b>{{ props.userCigar.total }}</b> time{{ props.userCigar.total > 1 ? 's' : '' }}
        </v-card-text>

        <v-card-text>
        </v-card-text>

        <!-- <v-card-actions>
            <v-btn
                color="orange-lighten-2"
                variant="text"
            >
                Explore
            </v-btn>

            <v-spacer></v-spacer>

            <v-btn
                :icon="show ? 'mdi-chevron-up' : 'mdi-chevron-down'"
                @click="show = !show"
            ></v-btn>
        </v-card-actions> -->
    </v-card>
</template>

<style scoped>
/* .user-cigar {
    display: grid;
    background: #fff;
    padding: 1rem;
    border-radius: 5px;
} */
</style>