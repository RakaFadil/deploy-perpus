<template>
   <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="card bg-base-100 glass w-full max-w-xl shrink-0 shadow-2xl">
                <form @submit.prevent="handleAuth()" class="card-body">
                    <div class="form-control">
                        <h1 class="text-4xl text-center text-accent font-bold">Welcome to Perpus App</h1>
                        <p class="text-2xl text-center font-bold">Sign into your account</p>
                        <div role="alert" class="alert alert-error my-4" v-if="authStore.isError">
                            <span>{{ authStore.errorMsg }}!</span>
                        </div>
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" placeholder="email" class="input input-bordered" required v-model="userInput.email"/>
                        </div>
                        <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" placeholder="password" class="input input-bordered mb-5" required v-model="userInput.password"/>
                        
                    </div>
                    
                    <div class="form-control">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
                <p class="text-center mb-4">
                     Dont' have an account? <RouterLink to="/register" class="mr-5 hover:text-primary">Sign up here</RouterLink>
                </p>
            </div>
            
            
        </div>
    </div>
</template>

<script setup>
import { useAuthStore } from '@/stores/AuthStore';
import { reactive } from "vue";

const authStore = useAuthStore();

const userInput = reactive({
    email: "",
    password: ""
});

const {loginUser} = authStore;

const handleAuth = () => {
    loginUser(userInput);
}
</script>