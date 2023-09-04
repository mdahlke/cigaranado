<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const name = ref('Test');
const brand = ref('');
const brandItems = ref([]);
const type = ref('Good');
const wrapper = ref('');
const wrapperOptions = ref([]);
const binder = ref('Tobacco');
const filler = ref('Weed');
const origin = ref('Cuba');
const strength = ref('Full');
const flavorProfile = ref('Spicy');
const flavorProfileOptions = ref([]);
const valid = ref(true);
const snackbar = ref(false);
const snackbarText = ref('');

onMounted(() => {
    const test = true;

    if(test){
        // name.set('Test');
    }

    axios.get('/brands/').then(response => {

        if(response.status !== 200) {
            return [];
        }
        brandItems.value = response.data.map(brand => {
            return {
                title: brand.name + ' (' + brand.manufacturer.name + ')',
                value: brand.id,
            };
        });
    }).catch(error => {
        console.log(error);
    });

    axios.get('/cigar-options/').then(response => {

        if(response.status !== 200) {
            return [];
        }
        flavorProfileOptions.value = response.data.flavor_profiles.map(option => {
            return option;
        })
        wrapperOptions.value = response.data.wrappers.map(option => {
            return option;
        })
    }).catch(error => {
        console.log(error);
    });
});

const submit = () => {

    if(!valid.value){
        return false;
    }

    const cigar = {
        name: name.value,
        brand_id: brand.value,
        type: type.value,
        wrapper: wrapper.value,
        binder: binder.value,
        filler: filler.value,
        origin: origin.value,
        strength: strength.value,
        flavor_profile: flavorProfile.value,
    };

    axios.post('/cigar', cigar).then(response => {
        if(response.status === 201){
            snackbarText.value = response.data.message;
            snackbar.value = true;
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
    // v => v.length >= 3 || 'Brand must be at 3 least characters',
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

const flavorProfileRules = [
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

        <v-container>
            <v-row>
                <v-col
                    cols="12"
                >

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
                                    <v-autocomplete
                                        v-model="brand"
                                        :items="brandItems"
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
                                    <v-autocomplete
                                        v-model="wrapper"
                                        :items="wrapperOptions"
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
                                    <v-autocomplete
                                        v-model="flavorProfile"
                                        :items="flavorProfileOptions"
                                        :rules="flavorProfileRules"
                                        label="Flavor Profile"
                                        required
                                        hide-details
                                    />
                                </v-col>


                                
                            </v-row>
                        </v-container>

                        <v-btn type="submit">Submit</v-btn>
                    </v-form>

                </v-col>
            </v-row>
        </v-container>
    </AuthenticatedLayout>
</template>