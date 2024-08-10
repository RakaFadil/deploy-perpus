<template>
   <div class="card bg-neutral text-neutral-content">
        <div class="card-body items-center text-center">
            <div class="avatar">
                <div class="ring-primary ring-offset-base-100 w-24 rounded-full ring ring-offset-2">
                    <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                </div>
            </div>
            <h2 class="card-title txt-white font-bold mb-4">Hi, {{ authStore.currentUser.name }}!</h2>
            <p>Email: </p>
            <input :placeholder=authStore.currentUser.email class="input input-bordered" required disabled />
            <p>Status Verified at: </p>
            <input :placeholder=authStore.currentUser.email_verified_at class="input input-bordered" required disabled />
            <div class="divider divider-secondary">Profile Info</div>

            <form @submit.prevent="handleUpdateProfile()">
                <p>Age: </p>
                <input :placeholder=profileInfo.age class="input input-bordered my-4" required v-model="age"/>
                <p>Bio: </p>
                <input :placeholder=profileInfo.bio class="input input-bordered my-4" required v-model="bio"/>
                <div class="card-actions justify-end">
                    <input type="submit" value="Update Profile" class="btn btn-outline btn-primary btn-block mt-4 text-white text-2xl">
                </div>
            </form>
            
        </div>
    </div>
    

</template>

<script setup>
import { useAuthStore } from '@/stores/AuthStore';
import {ref, onMounted} from "vue";
import { customAPI } from '@/api';
import { useRouter, useRoute } from "vue-router";

const authStore = useAuthStore();
const router = useRouter();

onMounted(() => {
    authStore.getMe();
})

const age = ref("");
const bio = ref("");

const profileInfo = ref("");

const getProfile = async () => {
    try {
        const { data } = await customAPI.get('/get-profile', {
            headers: { Authorization: `Bearer ${authStore.tokenUser}`}
        })

        profileInfo.value = data.data;

        console.log(data);
        // console.log(profileInfo);

    } catch (error) {
        console.log(error);
    }
}

onMounted(() => {
    getProfile();
})

const handleUpdateProfile = async () => {
    try {
        await customAPI.post (
            "/profile",
            {
                age: age.value,
                bio: bio.value,
            },
            {headers: {Authorization: `Bearer ${authStore.tokenUser}`}}
        );
        alert("Berhasil Update Profile");
        router.push({ name: "Home" });
    } catch (error) {
        console.log(error);
    }
} 


</script>