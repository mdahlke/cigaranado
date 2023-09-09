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
const strength = ref('Mild');
const strenthOptions = ref([
    'Mild', 'Medium', 'Full',
]);
const flavorProfile = ref([]);
const flavorProfileOptions = ref([]);
const valid = ref(true);
const snackbar = ref(false);
const snackbarText = ref('');

onMounted(() => {
    const test = true;

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
            return {
                title: option.name,
                value: option.id,
            };
        })
        wrapperOptions.value = response.data.wrappers.map(option => {
            return {
                title: option.name,
                value: option.id,
            };
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
];

const binderRules = [
    v => !!v || 'Binder is required',
];

const fillerRules = [
    v => !!v || 'Filler is required',
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
                                    <v-autocomplete
                                        v-model="binder"
                                        :items="wrapperOptions"
                                        :rules="binderRules"
                                        label="Binder"
                                        required
                                        hide-details
                                    />
                                </v-col>

                                <v-col
                                    cols="12"
                                >
                                    <v-autocomplete
                                        v-model="filler"
                                        :items="wrapperOptions"
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
                                    <v-autocomplete
                                        v-model="strength"
                                        :items="strenthOptions"
                                        :rules="strengthRules"
                                        label="Strength"
                                        required
                                        hide-details
                                    />
                                </v-col>

                                <v-col
                                    cols="12"
                                >
                                    <v-combobox
                                        v-model="flavorProfile"
                                        :items="flavorProfileOptions"
                                        :rules="flavorProfileRules"
                                        label="Flavor Profile"
                                        required
                                        hide-details
                                        multiple
                                        chips
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