<template>
    <div class="px-6 py-5">
        <h1 class="text-4xl px-4 font-bold text-white my-3 border-l-4 border-secondary rounded-s">Edit Category</h1>

        <form @submit.prevent="handleSubmit()" class="my-6">
           <label class="input input-bordered flex items-center gap-2">
               <input type="text" class="grow mb-2" placeholder="Masukan Nama Jenis Kategori Buku" v-model="name"/> 
           </label>
           <input type="submit" value="Tambah" class="btn btn-success font-bold mt-4 item-center text-white text-2xl">
       </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { customAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';
import { useRouter, useRoute } from "vue-router";

const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();

const name = ref("");

const CategoryById = async() => {
    const { data } = await customAPI(`/category/${route.params.id}`);
    name.value = data.data.name;
    console.log(data);
}

const handleSubmit = async () => {
    await customAPI.post (
            `/category/${route.params.id}?_method=PUT`,
            {
                name: name.value,
            },
            {headers: {Authorization: `Bearer ${authStore.tokenUser}`}}
        );
        alert("Berhasil Edit Kategori Buku")
        router.push({ name: "CategoriesAdmin" });
};

onMounted(() => {
    CategoryById();

})
</script>