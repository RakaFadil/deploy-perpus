<template>
    <div class="px-6 py-5">
        <p class="text-4xl text-start font-bold text-balance text-white">List All Roles</p>
        
        <div class="divider"></div>

        <RouterLink :to="{name: 'CreateRole'}" class="btn btn-outline btn-success my-3 font-bold text-lg">
            <i class="pi pi-plus-circle"></i>
            Add New Roles</RouterLink>

        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>Roles Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="hover" v-for="(roles, index) in listRoles" :key="roles.id">
                        <th>{{ index + 1 }}</th>
                        <td>{{ roles.id }}</td>
                        <td>{{ roles.name }}</td>
                        <td>
                            <div class="flex gap-3">

                                <RouterLink 
                                    :to="{ name: 'EditRole', params:{id:roles.id}}"
                                    class="btn btn-outline btn-info">
                                    <i class="pi pi-file-edit"></i>
                                </RouterLink>
                                <button 
                                    @click="deleteRole(roles.id)"
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

const listRoles = ref("");

const getRoles = async() => {
    const { data } = await customAPI.get("/role");
    listRoles.value = data.data;
};

const deleteRole = async (paramsId) => {
    await customAPI.post (
            `/role/${paramsId}?_method=DELETE`, null,
            {headers: {Authorization: `Bearer ${authStore.tokenUser}`}}
        );

    alert("Delete Jenis Role Berhasil");
    getRoles();
};


onMounted(() => {
    getRoles();
});

</script>