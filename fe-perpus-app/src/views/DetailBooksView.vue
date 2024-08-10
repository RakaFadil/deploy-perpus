<template>
    <div class="px-10 my-10">

        <div class="card card-side bg-primary-content shadow-xl">
            <figure>
                <img
                :src="detailBook.image"
                :alt="detailBook.title" 
                class="object-contain w-[750px] h-[400px]"/>
            </figure>
            <div class="card-body">
                <h2 class="card-title font-bold text-white text-4xl">{{ detailBook.title }}</h2>
                <div class="divider"></div>
                <div class="text-balance text-slate-400 text-xl">Deskripsi Buku:</div>
                <div class="text-prettier text-white text-xl">{{ detailBook.summary }}</div>
                <div class="divider"></div>
                <p class="text-balance text-white text-lg">Stok Buku : {{ detailBook.stok }}</p>
                <p class="text-balance text-white text-lg">Category : {{ categoryName }}</p>
                <div class="card-actions justify-end">
                    <RouterLink 
                    :to="{ name: 'CreateBorrow', params:{id:detailBook.id}}"
                    class="btn btn-accent text-xl">
                        <i class="pi pi-cart-arrow-down"></i>
                        Pinjam Buku
                    </RouterLink>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import { customAPI } from '@/api';
import { ref, onMounted } from "vue";
import { useRoute } from 'vue-router';
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore();

const route = useRoute();

const detailBook = ref("");
const categoryName = ref("");


const DetailById = async() => {
    const { data } = await customAPI.get(`/books/${route.params.id}`);
    detailBook.value = data.data;
    categoryName.value = data.data.category.name;
    console.log(data.data);
}

onMounted(() => {
    DetailById();
})



</script>