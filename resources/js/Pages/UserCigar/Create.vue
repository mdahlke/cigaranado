<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { VDatePicker } from 'vuetify/labs/VDatePicker'

import ImageKitUpload from '@/Components/ImageKitUpload.vue';

const working = ref(false);
const cigar = ref('');
const cigarItems = ref([]);
const rating = ref('');
const review = ref('');
const draw = ref('');
const burn = ref('');
const flavor = ref('');
const body = ref('');
const location = ref('');
const image = ref('');
const uploaded = ref([]);
const date = ref('');
const images = ref([]);

const nameRules = [
    v => !!v || 'Name is required',
    v => v.length >= 2 || 'Name must be at least characters',
];

axios.get('/cigars/').then(response => {

    if (response.status !== 200) {
        return [];
    }

    cigarItems.value = response.data.map(cigar => {
        return {
            title: cigar.name + ' (' + (cigar.brand?.name || 'unknown') + ' by ' + (cigar.brand?.manufacturer?.name || 'unknown') + ')',
            value: cigar.id,
        };
    });

}).catch(error => {
    console.log(error);
});

const submit = () => {
    working.value = true;

    // Create a new FormData instance
    const formData = new FormData();

    // Append each piece of data
    formData.append('cigar', cigar.value);
    formData.append('rating', rating.value);
    formData.append('review', review.value);
    formData.append('draw', draw.value);
    formData.append('burn', burn.value);
    formData.append('flavor', flavor.value);
    formData.append('body', body.value);
    formData.append('location', location.value);
    formData.append('date', date.value);

    // If uploaded.value is an array of files, append each file. 
    // If it's just a single file, you can append it directly.
    if (Array.isArray(uploaded.value)) {
        uploaded.value.forEach((file, index) => {
            formData.append(`image[${index}]`, file.file);
        });
    } else {
        formData.append('image', uploaded.value);
    }

    // Make the Axios POST request
    axios.post('/cigar/rate', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(response => {
            console.log({ response });
            console.log(response.data);
        })
        .catch(error => {
            console.log(error);
        })
        .finally(() => {
            working.value = false;
        });
};


</script>

<template>
    <AuthenticatedLayout>
        <v-icon icon="fas fa-plus" />
        <v-icon icon="mdi:mdi-home" />

        <Head title="Add Cigar" />

        <v-form :class="{'working': working}" v-model="valid" @submit.prevent="submit">
            <v-container>
                <v-row>
                    <v-col cols="12" md="4">
                        <v-autocomplete v-model="cigar" :items="cigarItems" :rules="nameRules" label="Cigar" required
                            hide-details />
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-text-field v-model="rating" label="Rating" required hide-details></v-text-field>
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-text-field v-model="review" label="Review" required hide-details></v-text-field>
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-text-field v-model="draw" label="Draw" required hide-details></v-text-field>
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-text-field v-model="burn" label="Burn" required hide-details />
                    </v-col>
                    <!--- i need to populate fields for my remaining refs -->
                    <v-col cols="12" md="4">
                        <v-text-field v-model="flavor" label="Flavor" required hide-details />
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-text-field v-model="body" label="Body" required hide-details />
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-text-field v-model="location" label="Location" required hide-details />
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-text-field v-model="image" label="Image" required hide-details />
                        <p>image kit field</p>
                        <image-kit-upload v-model="uploaded" :useUniqueFileName=true :isPrivateFile=true
                            customCoordinates="10,10,100,100" />
                        <p>/image kit field</p>
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-text-field type="datetime-local" v-model="date" label="Date" required />
                    </v-col>

                </v-row>
            </v-container>

            <v-btn type="submit">Submit</v-btn>
        </v-form>

    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>
form {
    position: relative;

    &.working{

        &::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            background: rgb(33 33 33 / 60%);
            height: 100%;
            width: 100%;
            z-index: 9;
        }

        &::after {
            content: 'w';
            position: sticky;
            display: block;
            bottom: 50%;
            text-align: center;
            animation: spin 2s alternate;
            z-index: 10;
        }
    }
}
</style>