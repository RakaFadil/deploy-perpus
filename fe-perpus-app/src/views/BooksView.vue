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
    
    <div class="px-6">
        <p class="text-4xl font-bold text-balance text-white font-poppins">Featured Books</p>
        <div class="divider"></div>

        <div class="collapse bg-black my-4">
            <input type="checkbox" />
            <div class="collapse-title text-xl font-medium">Click to show/hide Category</div>
            <div class="collapse-content">
                <div class="grid grid-cols-4 lg:grid-cols-8 my-4 gap-3" >
                    <RouterLink 
                    :to="{ name: 'DetailCategories', params:{id:category.id}}" 
                    class="btn btn-outline btn-primary rounded-full text-white text-lg" 
                    v-for="category in categories" :key="category.id" v-if="categories">
                        {{ category.name }}
                    </RouterLink>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 my-2 gap-3">
            <div class="card card-compact bg-primary-content shadow-xl" v-for="book in listBook" :key="book.id">
                <figure>
                <img
                    :src="book.image"
                    :alt="book.title" 
                    class="w-[300px] h-[300px]"/>
                </figure>
                <div class="card-body">
                <h2 class="card-title font-bold text-balance text-white">{{ book.title }}</h2>
                <p class="text-grey">{{ book.summary.substring(0,75) }} ...</p>
                <div class="card-actions justify-end">
                    <RouterLink 
                    :to="{ name: 'DetailBooks', params:{id:book.id}}" 
                    class="btn btn-outline btn-primary">
                    Detail Books
                    </RouterLink>
                </div>
                </div>
            </div>
        </div>

        
    </div>
</template>

<script setup>
import { customAPI } from '@/api';
import { ref, onMounted } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';

const listBook = ref("");

const getBooks = async () => {
  const { data } = await customAPI.get("/books");
  listBook.value = data.data;
};

onMounted(() => {
    getBooks();
})

const categories = ref("");

const allCategories = async() => {
    const { data } = await customAPI.get("/category");
    categories.value = data.data;
};

onMounted(() => {
    allCategories();
})



</script>