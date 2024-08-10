<template>
   <Navbar />
  <main class="mx-auto max-w-8xl mb-10 bg-base-100 rounded-xl min-h-[100vh]">

    <RouterView v-slot="{ Component, route }">
      <Transition name="fade" mode="out-in">
        <div :key="route.path">
          <component :is="Component"/>
        </div>
      </Transition>
    </RouterView>

  </main>
  <Footer />
</template>

<script setup>
import { RouterView } from "vue-router";
import Navbar from '@/components/layouts/Navbar.vue';
import Footer from "./components/layouts/Footer.vue";
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>