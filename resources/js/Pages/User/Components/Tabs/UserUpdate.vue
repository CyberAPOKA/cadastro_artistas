<template>
  <UpdateProfile :user="user" :cpfs="cpfs"></UpdateProfile>
  <UpdateAddress :user="user" :cpfs="cpfs"></UpdateAddress>
  <UpdateClipping :user="user" :cpfs="cpfs"></UpdateClipping>
  <UpdateFile :user="user" :cpfs="cpfs"></UpdateFile>
</template>
<script setup>
import UpdateProfile from "@/Pages/User/Components/Tabs/Edit/UpdateProfile.vue";
import UpdateAddress from "@/Pages/User/Components/Tabs/Edit/UpdateAddress.vue";
import UpdateFile from "@/Pages/User/Components/Tabs/Edit/UpdateFile.vue";
import UpdateClipping from "./Edit/updateClipping.vue";
const props = defineProps({
  user: Object,
  cpfs: Array,
});
</script>
