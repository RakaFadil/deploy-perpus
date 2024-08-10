<template>
    <div class="px-6 py-5">
        <p class="text-4xl text-start font-bold text-balance text-white">List All Books</p>
        <div class="px-80 py-5">
            <label class="input input-bordered rounded-full border-secondary flex items-center gap-2">
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
        
        <div class="divider"></div>
        <RouterLink :to="{name: 'CreateBook'}" class="btn btn-outline btn-success my-3 font-bold text-lg">
            <i class="pi pi-plus-circle"></i>
            Add New Book</RouterLink>

        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>Book Id</th>
                    <th>Title</th>
                    <th>Summary/Synopsys</th>
                    <th>Stok</th>
                    <th>Action</th>
                </tr>
                </thead>
                    <tbody>
                    <tr class="hover" v-for="(listBook, index) in listBook" :key="listBook.id">
                        <th><td>{{ index+1 }}</td></th>
                        <td class="text-balance">{{ listBook.id }}</td>
                        <td>{{ listBook.title }}</td>
                        <td class="text-balance">{{ listBook.summary }}</td>
                        <td>{{ listBook.stok }}</td>
                        <td>
                            <div class="flex gap-3">

                                <RouterLink 
                                    :to="{ name: 'EditBooks', params:{id:listBook.id}}"
                                    class="btn btn-outline btn-info">
                                    <i class="pi pi-file-edit"></i>
                                </RouterLink>
                                <button 
                                    @click="deleteBook(listBook.id)" 
                                    class="btn btn-outline btn-error">
                                    <i class="pi pi-trash"></i>
                                </button>

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
import { ref, onMounted } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore();

const listBook = ref("");

const getBook = async () => {
  const { data } = await customAPI.get("/books");
  listBook.value = data.data;
  console.log(data.data);
  
};

const deleteBook = async (paramsId) => {
    await customAPI.post (
            `/books/${paramsId}?_method=DELETE`, null,
            {headers: {Authorization: `Bearer ${authStore.tokenUser}`}}
        );

    alert("Delete Buku Berhasil");
    getBook();
};


onMounted(() => {
    getBook();
})

</script>