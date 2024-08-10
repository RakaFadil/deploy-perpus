<template>
    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="card glass bg-base-100 w-full max-w-xl shrink-0 shadow-2xl">
                <form @submit.prevent="handleAuth()" class="card-body">
                    <div class="form-control">
                        <h1 class="text-4xl text-center text-accent font-bold">Welcome to Perpus App</h1>
                        <p class="text-2xl text-center font-bold">Register your account</p>
                        <label class="label">
                            <span class="label-text">Username</span>
                        </label>
                        <input type="text" placeholder="Username" class="input input-bordered" required v-model="userInput.name"/>
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" placeholder="email" class="input input-bordered" required v-model="userInput.email"/>
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" placeholder="password" class="input input-bordered" required v-model="userInput.password"/>
                        <label class="label">
                            <span class="label-text">Password Confirmation</span>
                        </label>
                        <input type="password" placeholder="password confirmation" class="input input-bordered" required v-model="userInput.password_confirmation"/>
                        
                    </div>
                    
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useAuthStore } from '@/stores/AuthStore';
import { reactive } from "vue";

const authStore = useAuthStore();

const userInput = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const {registerUser} = authStore;

const handleAuth = () => {
    registerUser(userInput);
}
</script>