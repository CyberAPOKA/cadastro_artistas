<template>
  <Navbar></Navbar>
  <Carousel></Carousel>

  <LogisticServiceTabs :user="user" :acting="acting"></LogisticServiceTabs>
  <Footer></Footer>
</template>

<script setup>
import { ref } from "vue";
import Navbar from "@/Pages/User/Layout/Navbar.vue";
import Footer from "@/Pages/User/Layout/Footer.vue";
import Carousel from "@/Pages/User/Components/Carousel.vue";
import LogisticServiceTabs from "@/Pages/User/Components/LogisticServiceTabs.vue";

const props = defineProps({
  user: Object,
  acting: Object,
});
</script>
