<template>
    <div class="mx-auto max-w-3xl border-4 bg-primary-content rounded-xl border-accent px-5 py-3 my-10">
       <h1 class="text-primary text-center text-3xl font-bold mb-2">Form Peminjaman</h1>

       <form @submit.prevent="handleSubmit()" class="my-6">

            <p>Tanggal Peminjaman Buku</p>
           <label class="input input-bordered flex items-center gap-2 my-4">
               <input type="date" class="grow mb-2" placeholder="Masukan Tanggal Peminjaman Buku" v-model="borrow_date"/> 
           </label>

           <p>Tanggal Pengembalian Buku</p>
           <label class="input input-bordered flex items-center gap-2 my-4">
               <input type="date" class="grow mb-2" placeholder="Masukan Tanggal Pengembalian Buku" v-model="load_date"/> 
           </label>

           <p>User Id</p>
           <label class="input input-bordered flex items-center gap-2 my-4">
               <input type="text" class="grow mb-2" :placeholder=user_id v-model="user_id" disabled/> 
           </label>

           <p>Book Id</p>
           <label class="input input-bordered flex items-center gap-2 my-4">
               <input type="text" class="grow mb-2" :placeholder=book_id v-model="book_id" disabled/> 
           </label>


           <input type="submit" value="Pinjam Buku" class="btn btn-outline btn-accent font-bold btn-block mt-4 text-white text-2xl">
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

const borrow_date = ref("");
const load_date = ref("");
const user_id = ref("");
const book_id = ref("");

const userById = async() => {
    const { data } = await customAPI(`/me`, {headers: {Authorization: `Bearer ${authStore.tokenUser}`}});
    user_id.value = data.user.id;
}

onMounted(() => {
    userById();
})

const DetailBookById = async() => {
    const { data } = await customAPI.get(`/books/${route.params.id}`);
    // detailBook.value = data.data;
    // categoryName.value = data.data.category.name;
    book_id.value = data.data.id;
    console.log(data.data.id);
}

onMounted(() => {
    DetailBookById();
})

const handleSubmit = async () => {
    await customAPI.post (
            "/borrow",
            {
                borrow_date: borrow_date.value,
                load_date: load_date.value,
                user_id: user_id.value,
                book_id: book_id.value,
            },
            {headers: {Authorization: `Bearer ${authStore.tokenUser}`}}
        );
        alert("Berhasil Tambah Peminjaman Buku")
        router.push({ name: "Books" });
};

</script>

