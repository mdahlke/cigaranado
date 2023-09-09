<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { VDatePicker } from 'vuetify/labs/VDatePicker'

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
const date = ref('');

const nameRules = [
    v => !!v || 'Name is required',
    v => v.length >= 2 || 'Name must be at least characters',
];


axios.get('/cigars/').then(response => {

    if(response.status !== 200) {
        return [];
    }
    cigarItems.value = response.data.map(cigar => {
        console.log(cigar);
        return {
            title: cigar.name + ' ('+ (cigar.brand?.name || 'unknown') + ' by ' + (cigar.brand?.manufacturer?.name || 'unknown') + ')',
            value: cigar.id,
        };
    });
    }).catch(error => {
    console.log(error);
});

const submit = () => {
    axios.post('/cigar/rate', {
        cigar: cigar.value,
        rating: rating.value,
        review: review.value,
        draw: draw.value,
        burn: burn.value,
        flavor: flavor.value,
        body: body.value,
        location: location.value,
        image: image.value,
        date: date.value,
    })
    .then(response => {
        console.log({response});
        console.log(response.data);
    })
    .catch(error => {
        console.log(error);
    });
};

</script>

<template>
    <AuthenticatedLayout>
        <Head title="Add Cigar" />

        <v-form
            v-model="valid"
            @submit.prevent="submit">
            <v-container>
                <v-row>
                    <v-col
                    cols="12"
                    md="4"
                    >
                        <v-autocomplete
                            v-model="cigar"
                            :items="cigarItems"
                            :rules="nameRules"
                            label="Cigar"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                    cols="12"
                    md="4"
                    >
                    <v-text-field
                        v-model="rating"
                        label="Rating"
                        required
                        hide-details
                    ></v-text-field>
                    </v-col>

                    <v-col
                    cols="12"
                    md="4"
                    >
                    <v-text-field
                        v-model="review"
                        label="Review"
                        required
                        hide-details
                    ></v-text-field>
                    </v-col>

                    <v-col
                    cols="12"
                    md="4"
                    >
                    <v-text-field
                        v-model="draw"
                        label="Draw"
                        required
                        hide-details
                    ></v-text-field>
                    </v-col>
                    
                    <v-col
                    cols="12"
                    md="4"
                    >
                        <v-text-field
                            v-model="burn"
                            label="Burn"
                            required
                            hide-details
                        />
                    </v-col>
                    <!--- i need to populate fields for my remaining refs -->
                    <v-col
                    cols="12"
                    md="4"
                    >
                        <v-text-field
                            v-model="flavor"
                            label="Flavor"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                    cols="12"
                    md="4"
                    >
                        <v-text-field
                            v-model="body"
                            label="Body"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                    cols="12"
                    md="4"
                    >
                        <v-text-field
                            v-model="location"
                            label="Location"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                    cols="12"
                    md="4"

                    >
                        <v-text-field
                            v-model="image"
                            label="Image"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                        cols="12"
                        md="4"
                    >
                        <!-- i need to bind the date picker to an input -->
                        
                        <v-text-field   
                            type="datetime-local"
                            v-model="date"
                            label="Date"
                            required
                        />
                    </v-col>

                </v-row>
            </v-container>

            <v-btn type="submit">Submit</v-btn>
        </v-form>

    </AuthenticatedLayout>
</template>