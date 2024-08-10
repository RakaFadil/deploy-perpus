<template>
    <div
        class="hero h-60 rounded-xl"
        style="background-image: url(https://wallpapers.com/images/hd/library-background-xkh9vqzcdoxcs7v7.jpg);">
        <div class="hero-overlay bg-opacity-30"></div>
        <div class="hero-content text-neutral-content text-center">
            <div class="max-w-md">
            <h1 class="mb-5 text-5xl font-bold text-white font-poppins">Browse All Categories</h1>
            </div>
        </div>
    </div>

    <div class="px-6 py-5">
        <p class="text-4xl text-start font-bold text-balance text-white">List All Categories</p>
        
        <div class="divider"></div>

        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead class="text-lg">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="text-xl">
                    <tr class="hover" v-for="(category, index) in listCategories" :key="category.id">
                        <th>{{ index + 1 }}</th>
                        <td>{{ category.name }}</td>
                        <td>
                            <div class="flex gap-3">
                                <RouterLink 
                                    :to="{ name: 'DetailCategories', params:{id:category.id}}"
                                    class="btn btn-outline btn-info">
                                    <i class="pi pi-info-circle"></i>
                                    See More
                                </RouterLink>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { RouterLink } from "vue-router";
import { customAPI } from '@/api';
import {onMounted, ref} from "vue";
import { useAuthStore } from '@/stores/AuthStore';
import { useRoute } from 'vue-router';

const route = useRoute();

const authStore = useAuthStore();

const listCategories = ref("");

const getCategory = async() => {
    const { data } = await customAPI.get("/category");
    listCategories.value = data.data;
};


onMounted(() => {
    getCategory();
});



</script>