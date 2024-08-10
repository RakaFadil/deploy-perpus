<template>
    <div class="px-40 py-8 ">
        <label class="input input-bordered border-secondary rounded-full flex items-center gap-2">
            <input type="text" class="grow" placeholder="Search Book" />
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 16 16"
                fill="currentColor"
                class="h-4 w-4 opacity-70">
                <path
                fill-rule="evenodd"
                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                clip-rule="evenodd" />
            </svg>
        </label>
    </div>

    <div class="px-6" v-if="categories">
        <p class="text-4xl font-bold text-balance text-white font-poppins">{{ categories.name }} ({{ categories.list_books.length }})</p>
        <div class="divider"></div>

        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 my-2 gap-3" v-if="categories.list_books.length">
            <div class="card card-compact bg-primary-content shadow-xl" v-for="item in categories.list_books" :key="item.id">
                <figure>
                <img
                    :src="item.image"
                    :alt="item.title" 
                    class="w-[300px] h-[300px]"/>
                </figure>
                <div class="card-body">
                <h2 class="card-title font-bold text-balance text-white">{{ item.title }}</h2>
                <p class="text-grey">{{ item.summary.substring(0,75) }} ...</p>
                <div class="card-actions justify-end">
                    <RouterLink 
                    :to="{ name: 'DetailBooks', params:{id:item.id}}" 
                    class="btn btn-outline btn-primary">
                    Detail Books
                    </RouterLink>
                </div>
                </div>
            </div>
        </div>

        <div v-else>
            <h1>Tidak ada buku di kategori ini</h1>
        </div>
    </div>
    
</template>

<script setup>
import { customAPI } from '@/api';
import { ref, onMounted } from "vue";
import { useRoute } from 'vue-router';

const route = useRoute();

const categories = ref("");

const CategoryById = async() => {
    const { data } = await customAPI(`/category/${route.params.id}`);
    categories.value = data.data;
}

onMounted(() => {
    CategoryById();
})
</script>