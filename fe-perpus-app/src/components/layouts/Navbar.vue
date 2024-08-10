<template>

    <div class="navbar bg-transparent text-white font-bold font-poppins">

      <div class="navbar-start">
          <div class="dropdown">
              <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                  <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 12h8m-8 6h16" />
                  </svg>
              </div>
              <ul
                  tabindex="0"
                  class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                  <li v-for="nav in listNav" :key="nav.id">
                      <RouterLink :to="nav.url">{{ nav.name }}</RouterLink>
                  </li>

                  <li><RouterLink to="/adminPage" class="mr-5 hover:text-primary" v-if="authStore.currentUser && authStore.currentUser.role.name === 'admin'">Admin Page</RouterLink></li>

                  <div class="divider divider-secondary"></div>
                  <li><RouterLink to="/login" class="mr-5 hover:text-primary">Login</RouterLink></li>
                  <li><RouterLink to="/register" class="mr-5 hover:text-primary">Register</RouterLink></li>
                  <li><RouterLink to="/profile" class="mr-5 hover:text-primary">Profile</RouterLink></li>
                  
                  <li v-if="authStore.tokenUser" @click="handleLogout"><a>Logout</a></li>
              </ul>
          </div>
          <div class="flex-1">
            <RouterLink to="/" class="btn btn-ghost text-3xl text-accent">Perpus App</RouterLink>
          </div>
          
      </div>

      <div class="navbar-end hidden lg:flex">
        
          <ul class="menu menu-horizontal px-1">
            <li v-for="nav in listNav" :key="nav.id">
                <RouterLink :to="nav.url" class="hover:text-secondary">{{ nav.name }}</RouterLink>
            </li>
            <li><RouterLink to="/adminPage" class="mr-5 hover:text-primary" v-if="authStore.currentUser && authStore.currentUser.role.name === 'admin'">Admin Page</RouterLink></li>
          </ul>
        <div class="dropdown dropdown-end">
          <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
            <div class="w-10 rounded-full">
              <img
                alt="Tailwind CSS Navbar component"
                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
            </div>
          </div>
          <ul
            tabindex="0"
            class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow text-white">
            <li><RouterLink to="/login" class="mr-5 hover:text-primary">Login</RouterLink></li>
            <li><RouterLink to="/register" class="mr-5 hover:text-primary">Register</RouterLink></li>
            <li><RouterLink to="/profile" class="mr-5 hover:text-primary">Profile</RouterLink></li>
            
            <li v-if="authStore.tokenUser" @click="handleLogout"><a>Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
</template>

<script setup>

import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore();

const handleLogout = () => {
    authStore.logoutUser();
}

const listNav = [
    {
        id : 1,
        name : "Home",
        url: '/' 
    },
    {
        id : 2,
        name : "Books Catalog",
        url: '/books' 
    },
    {
        id : 3,
        name : "Categories",
        url: '/category' 
    },
]
</script>