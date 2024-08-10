<template>
    <div class="px-6 py-5">
        <p class="text-4xl text-start font-bold text-balance text-white">List All Borrows Book Data</p>
        
        <div class="divider"></div>

        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>Data Id</th>
                    <th>Name</th>
                    <th>Title Books</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- row 1 -->
                <tr class="hover" v-for="(borrow, index) in listBorrow" :key="borrow.id">
                    <th>{{ index + 1 }}</th>
                    <td>{{ borrow.id }}</td>
                    <td>{{ borrow.user.name }}</td>
                    <td>{{ borrow.books.title }}</td>
                    <td>{{ borrow.borrow_date }}</td>
                    <td>{{ borrow.load_date }}</td>
                    <td>Incomplete</td>
                    <td>
                        <div class="flex gap-3">
                            <button 
                                @click="deleteBorrows(borrow.id)"
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

const listBorrow = ref("");

const getBorrows = async () => {
  const { data } = await customAPI.get("/borrow");
  listBorrow.value = data.data;
  console.log(data.data);
};

const deleteBorrows = async (paramsId) => {
    await customAPI.post (
            `/borrow/delete/${paramsId}`, null,
            {headers: {Authorization: `Bearer ${authStore.tokenUser}`}}
        );

    alert("Delete data peminjaman Berhasil");
    getBorrows();
};

onMounted(() => {
    getBorrows();
})

</script>