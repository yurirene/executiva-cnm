<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Delegado" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Delegado
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                            <table id="dataTable" :data-route="route('delegados.datatable')" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th>nome</th>
                                        <th>federacao</th>
                                        <th>estado</th>
                                        <th>regiao</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
