<template>
    <div class="px-6 py-5">
        <p class="text-4xl text-start font-bold text-balance text-white">List All Categories</p>
        
        <div class="divider"></div>

        <RouterLink :to="{name: 'CreateCategory'}" class="btn btn-outline btn-success my-3 font-bold text-lg">
            <i class="pi pi-plus-circle"></i>
            Add New Category</RouterLink>

        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>Category Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="hover" v-for="(category, index) in listCategories" :key="category.id">
                        <th>{{ index + 1 }}</th>
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td>
                            <div class="flex gap-3">

                                <RouterLink 
                                    :to="{ name: 'EditCategory', params:{id:category.id}}"
                                    class="btn btn-outline btn-info">
                                    <i class="pi pi-file-edit"></i>
                                </RouterLink>
                                <button 
                                    @click="deleteCategory(category.id)"
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
import {onMounted, ref} from "vue";
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore();

const listCategories = ref("");

const getCategory = async() => {
    const { data } = await customAPI.get("/category");
    listCategories.value = data.data;
};

const deleteCategory = async (paramsId) => {
    await customAPI.post (
            `/category/${paramsId}?_method=DELETE`, null,
            {headers: {Authorization: `Bearer ${authStore.tokenUser}`}}
        );

    alert("Delete Kategori Berhasil");
    getCategory();
};


onMounted(() => {
    getCategory();
});

</script>