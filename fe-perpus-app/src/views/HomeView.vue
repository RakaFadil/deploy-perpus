<template>
  <div class="hero bg-base-200 min-h-screen" style="background-image: url(https://images.stockcake.com/public/1/4/1/14115757-439e-4d40-8c49-60fad2934490_large/pensive-library-statue-stockcake.jpg);">
    <div class="hero-overlay bg-opacity-40"></div>
        <div class="hero-content flex-col lg:flex-row-reverse">
          <div>
            <h1 class="text-5xl font-bold text-balance text-white font-poppins">Explore, Learn, and Discover New Knowledge at Library.</h1>
            <h1 class="text-5xl font-bold text-balance text-success font-poppins mt-4">Your Library: Anytime, Anywhere</h1>
            <p class="mt-6 text-balance text-white font-poppins">
              Unlock a World of Knowledge and Adventure with Every Visit
            </p>
            <p class="mb-4 text-balance text-white font-poppins">
              Always free - no fees or subscriptions.
            </p>
            <a href="#section1" class="rounded-full btn btn-accent font-poppins">Get Started</a>
          </div>
        </div>
  </div>

  <div class="py-10 px-6 bg-gradient-to-b from-neutral-800 to-base-100" id="section1">
    <p class="text-4xl font-bold text-balance text-white font-poppins">Explore & read millions of</p>
    <p class="text-4xl font-bold text-balance text-white font-poppins">books for free</p>
    <RouterLink to="/books" class="btn btn-accent my-10 text-xl font-bold font-poppins">Browse our collection</RouterLink>
  </div>


  <div class="px-6">
    <p class="text-4xl text-center font-bold text-balance text-white font-poppins">New Release Book</p>
    <p class="text-xl text-center font-bold text-balance text-error font-poppins">Refers to a book that has recently been published and made available for borrowing</p>
    <div class="divider"></div>
    
    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 my-2 gap-3">
          <div 
          class="card card-compact bg-primary-content shadow-xl" 
          v-for="book in listBook.slice(0, 6)" :key="book.id">
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

  <div class="px-6">
    <p class="text-4xl text-center font-bold text-balance text-white font-poppins">Recommend for you</p>
    <p class="text-xl text-center font-bold text-balance text-error font-poppins">Read something new, recommended by our staff librarians</p>
    <div class="divider"></div>
  
    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 my-2 gap-3">
          <div 
          class="card card-compact bg-primary-content shadow-xl" 
          v-for="book in listBook.slice(0, 6)" :key="book.id">
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
import { useAuthStore } from '@/stores/AuthStore';
import { customAPI } from '@/api';
import {ref, onMounted} from "vue";

const authStore = useAuthStore();

const listBook = ref("");

const getBooks = async () => {
  const { data } = await customAPI.get("/books");
  listBook.value = data.data;
};



onMounted(() => {
    getBooks();
})
</script>