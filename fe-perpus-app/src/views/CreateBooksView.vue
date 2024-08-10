<template>
    <div class="px-6">
        <h1 class="text-4xl px-4 font-bold text-white my-3 border-l-4 border-secondary rounded-s">Create Book</h1>

        <form @submit.prevent="handleSubmit">
            <label class="input input-bordered flex items-center gap-2 my-4 text-white font-bold">
                Title
                <input type="text" class="grow" placeholder="Masukan Title Buku" v-model="books.title"/>
            </label>

            <label class="grid items-center gap-2 my-4">
                <p class="font-bold text-white">
                Summary
                </p>
                <textarea class="textarea textarea-bordered" rows="3"  placeholder="Masukan Summary/Synopsis Buku" v-model="books.summary"></textarea>
            </label>

            <label class="input input-bordered flex items-center gap-2 my-4 font-bold text-white">
                Stok
                <input type="text" class="grow"  placeholder="Masukan Stok Buku" v-model="books.stok"/>
            </label>

            <p class="font-bold text-white">
                Category Books
            </p>

            <label class="flex items-center gap-2 my-4 text-white">
                <select class="select select-bordered w-full max-w-xs" v-if="category" :category="category" v-model="books.category_id">
                    <option disabled selected>Kategori Buku</option>
                    <option :value="category.id" v-for="category in category">
                        {{ category.name }}
                    </option>
                </select>
            </label>

            <p class="font-bold text-white">
                Cover Buku
            </p>

            <label class="flex items-center gap-2 my-4">
                <input type="file" class="file-input file-input-bordered w-full max-w-xs" @change="handleUpload"/>
            </label>

            <input type="submit" value="Tambah" class="btn btn-secondary btn-block">
        </form>
    </div>
     
</template>

<script setup>
import { customAPI } from "@/api";
import { reactive, ref, onMounted } from "vue";
import { useAuthStore } from '@/stores/AuthStore';
import { useRouter, useRoute } from "vue-router";

const authStore = useAuthStore();
const route = useRoute();
const router = useRouter();

const books = reactive({
    title: "",
    summary: "",
    stok: "",
    image: null,
    category_id: "",
});

const handleUpload = (e) => {
    const selectImage = e.target.files[0];

    books.image = selectImage;
};

const category = ref("");

const AllCategory = async () => {
    const { data } = await customAPI.get("/category");
    console.log(data.data);
    category.value = data.data;
}

onMounted(() => {
    AllCategory();
})

const handleSubmit = async() => {
    try {
        let formData = new FormData();

        formData.append("title", books.title);
        formData.append("summary", books.summary);
        formData.append("image", books.image);
        formData.append("category_id", books.category_id);
        formData.append("stok", books.stok);
        

        const newBook = await customAPI.post("/books", formData, {headers: {Authorization: `Bearer ${authStore.tokenUser}`}});

        console.log(newBook);
        alert("Tambah Buku Berhasil");
        router.push({ name: "BooksAdmin" });
    } catch (error) {
        console.log(error);
    }
};

</script>