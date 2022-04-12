<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Importar Delegados" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Importar Delegados
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="row">
                            <div class="col">
                                <div class="mt-5 md:mt-0 md:col-span-2">
                                    <form action="#" method="POST">
                                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700"> Planilha </label>
                                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                        <div class="space-y-1 text-center">
                                                            
                                                            <div class="flex text-sm text-gray-600">
                                                                <label for="planilha" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                                    <span>Upload arquivo</span>
                                                                    <input id="planilha" name="planilha" type="file" class="sr-only">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Importar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </BreezeAuthenticatedLayout>
</template>
