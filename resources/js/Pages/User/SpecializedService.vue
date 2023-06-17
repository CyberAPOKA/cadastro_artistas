<template>
  <Navbar></Navbar>
  <Carousel></Carousel>

  <SpecializedServiceTabs :user="user" :acting="acting"></SpecializedServiceTabs>
  <Footer></Footer>
</template>

<script setup>
import { ref } from "vue";
import Navbar from "@/Pages/User/Layout/Navbar.vue";
import Footer from "@/Pages/User/Layout/Footer.vue";
import Carousel from "@/Pages/User/Components/Carousel.vue";
import SpecializedServiceTabs from "@/Pages/User/Components/SpecializedServiceTabs.vue";

const props = defineProps({
  user: Object,
  acting: Object,
});
</script>
