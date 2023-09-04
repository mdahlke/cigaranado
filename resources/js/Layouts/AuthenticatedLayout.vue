<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const drawer = ref(false);
const items = ref([
    {
        name: 'dashboard',
        title: 'Dashboard',
        icon: 'mdi-view-dashboard',
        href: '/dashboard',
    },
    {
        name: 'cigar.create',
        title: 'Add Cigar',
        icon: 'mdi-cigar',
        href: '/cigar/create',
    },
    {
        name: 'cigar.rate',
        title: 'Rate a Cigar',
        icon: 'mdi-cigar',
        href: '/cigars/rate',
    }
]);

defineProps({
    pageTitle: {
        type: String,
        required: false,
        default: null,
    },
});
</script>

<template>
    <div>
        {{ route('cigar.create') }}

        <v-layout>

            <v-app-bar color="primary" prominent>
                
                <v-app-bar-title>Cigaronado</v-app-bar-title>
                
                <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

            </v-app-bar>

            <v-navigation-drawer 
                v-model="drawer" 
                location="right" 
                temporary
            >
                <v-list >
                    <v-list-item
                        v-for="item in items"
                        :key="item.title"
                        :title="item.title"
                        :href="item.href" 
                        :active="item.name === route().current()"
                    >
                        <template v-slot:append>
                        <v-btn
                            size="small"
                            variant="text"
                            icon="mdi-menu-down"
                        ></v-btn>
                        </template>
                    </v-list-item>

                </v-list>
            </v-navigation-drawer>



            <!-- Page Content -->
            <v-main>

                <!-- Page Heading -->
                <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>
                <slot />
            </v-main>

        </v-layout>
    </div>
</template>
