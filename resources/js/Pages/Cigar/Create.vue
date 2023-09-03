<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const name = ref('Test');
const brand = ref('Michael');
const type = ref('Good');
const wrapper = ref('Cuban');
const binder = ref('Tobacco');
const filler = ref('Weed');
const origin = ref('Cuba');
const strength = ref('Full');
const flavor_profile = ref('Spicy');
const valid = ref(true);
const snackbar = ref(false);
const snackbarText = ref('');

onMounted(() => {
    const test = true;

    if(test){
        // name.set('Test');
    }
});

const submit = () => {

    if(!valid.value){
        return false;
    }

    const cigar = {
        name: name.value,
        brand: brand.value,
        type: type.value,
        wrapper: wrapper.value,
        binder: binder.value,
        filler: filler.value,
        origin: origin.value,
        strength: strength.value,
        flavor_profile: flavor_profile.value,
    };

    axios.post('/cigar', cigar).then(response => {
        console.log({response}, response.data.message);
        if(response.status === 201){
            snackbarText.value = response.data.message;
            snackbar.value = true;

            consoe
        }
        return false;
    }).catch(error => {
        snackbarText.value = response.data.message;
        snackbar.value = true;
        console.log(error);
    });

    return false;
}


const nameRules = [
    v => !!v || 'Name is required',
    v => v.length >= 3 || 'Name must be at 3 least characters',
];

const brandRules = [
    v => !!v || 'Brand is required',
    v => v.length >= 3 || 'Brand must be at 3 least characters',
];

const typeRules = [
    v => !!v || 'Type is required',
    v => v.length >= 3 || 'Type must be at 3 least characters',
];

const wrapperRules = [
    v => !!v || 'Wrapper is required',
    v => v.length >= 3 || 'Wrapper must be at 3 least characters',
];

const binderRules = [
    v => !!v || 'Binder is required',
    v => v.length >= 3 || 'Binder must be at 3 least characters',
];

const fillerRules = [
    v => !!v || 'Filler is required',
    v => v.length >= 3 || 'Filler must be at 3 least characters',
];

const originRules = [
    v => !!v || 'Origin is required',
    v => v.length >= 3 || 'Origin must be at 3 least characters',
];

const strengthRules = [
    v => !!v || 'Strength is required',
    v => v.length >= 3 || 'Strength must be at 3 least characters',
];

const flavor_profileRules = [
    v => !!v || 'Flavor Profile is required',
    v => v.length >= 3 || 'Flavor Profile must be at 3 least characters',
];

</script>

<template>
    <AuthenticatedLayout>
        <Head title="Add Cigar" />

        <v-snackbar
            v-model="snackbar"
        >
            {{ snackbarText }}
        </v-snackbar>

        <v-form
            v-model="valid"
            @submit.prevent="submit">
            <v-container>
                <v-row>

                    <v-col
                        cols="12"
                    >
                        <v-text-field
                            v-model="name"
                            :rules="nameRules"
                            label="Cigar Name"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                        cols="12"
                    >
                        <v-text-field
                            v-model="brand"
                            :rules="brandRules"
                            label="Brand"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                        cols="12"
                    >
                        <v-text-field
                            v-model="type"
                            :rules="typeRules"
                            label="Type"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                        cols="12"
                    >
                        <v-text-field
                            v-model="wrapper"
                            :rules="wrapperRules"
                            label="Wrapper"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                        cols="12"
                    >
                        <v-text-field
                            v-model="binder"
                            :rules="binderRules"
                            label="Binder"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                        cols="12"
                    >
                        <v-text-field
                            v-model="filler"
                            :rules="fillerRules"
                            label="Filler"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                        cols="12"
                    >
                        <v-text-field
                            v-model="origin"
                            :rules="originRules"
                            label="Origin"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                        cols="12"
                    >
                        <v-text-field
                            v-model="strength"
                            :rules="strengthRules"
                            label="Strength"
                            required
                            hide-details
                        />
                    </v-col>

                    <v-col
                        cols="12"
                    >
                        <v-text-field
                            v-model="flavor_profile"
                            :rules="flavor_profileRules"
                            label="Flavor Profile"
                            required
                            hide-details
                        />
                    </v-col>


                    
                </v-row>
            </v-container>

            <v-btn type="submit">Submit</v-btn>
        </v-form>

    </AuthenticatedLayout>
</template>