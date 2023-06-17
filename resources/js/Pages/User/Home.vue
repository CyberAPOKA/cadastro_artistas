<template>
  <Navbar></Navbar>
  <Carousel></Carousel>
  <Tabs :user="user" :acting="acting" :cpfs="cpfs"></Tabs>
  <Footer></Footer>
</template>

<script setup>
import Navbar from "@/Pages/User/Layout/Navbar.vue";
import Footer from "@/Pages/User/Layout/Footer.vue";
import Carousel from "@/Pages/User/Components/Carousel.vue";
import Tabs from "@/Pages/User/Components/Tabs.vue";
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
onMounted(() => {
  initFlowbite();
});
const props = defineProps({
  user: Object,
  acting: Object,
  cpfs: Array,
});
</script>
