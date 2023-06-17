<template>
  <div class="container mx-auto px-4 mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul
      class="flex flex-wrap -mb-px text-sm font-medium text-center"
      id="myTab"
      data-tabs-toggle="#myTabContent"
      role="tablist"
    >
      <li class="mr-2" role="presentation">
        <button
          class="inline-block p-4 border-b-2 rounded-t-lg"
          id="profile-tab"
          data-tabs-target="#profile"
          type="button"
          role="tab"
          aria-controls="profile"
          aria-selected="false"
        >
          <div v-if="user.profile?.name">MEUS DADOS</div>
          <div v-else>CADASTRE SEU SERVIÇO</div>
        </button>
      </li>
      <li class="mr-2" role="presentation">
        <button
          class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
          id="dashboard-tab"
          data-tabs-target="#dashboard"
          type="button"
          role="tab"
          aria-controls="dashboard"
          aria-selected="false"
        >
          SERVIÇOS LOGÍSTICOS
        </button>
      </li>
      <li class="mr-2" role="presentation">
        <button
          class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
          id="settings-tab"
          data-tabs-target="#settings"
          type="button"
          role="tab"
          aria-controls="settings"
          aria-selected="true"
        >
          <a :href="route('home')">SERVIÇOS ESPECIALIZADOS</a>
        </button>
      </li>
    </ul>
  </div>
  <div id="myTabContent">
    <div
      class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 container mx-auto mb-8"
      id="profile"
      role="tabpanel"
      aria-labelledby="profile-tab"
    >
      <UserUpdate v-if="user.profile?.name" :user="user"></UserUpdate>
      <Register v-else></Register>
    </div>
    <div
      class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 container mx-auto mb-8"
      id="dashboard"
      role="tabpanel"
      aria-labelledby="dashboard-tab"
    >
      <!-- <UsersLogistics :acting="acting" :user="user"></UsersLogistics> -->
      <LogisticServices></LogisticServices>
    </div>
    <div
      class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 container mx-auto mb-8"
      id="settings"
      role="tabpanel"
      aria-labelledby="settings-tab"
    >
      <UsersSpecializeds :acting="acting" :user="user"></UsersSpecializeds>
      <!-- <SpecializedServices></SpecializedServices> -->
    </div>
  </div>
</template>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import Register from "@/Pages/User/Components/Tabs/Register.vue";
import UserUpdate from "@/Pages/User/Components/Tabs/UserUpdate.vue";
import UsersLogistics from "@/Pages/User/Components/Tabs/UsersLogistics.vue";
import UsersSpecializeds from "@/Pages/User/Components/Tabs/UsersSpecializeds.vue";

import LogisticServices from "@/Pages/User/Components/Tabs/LogisticServices.vue";
import SpecializedServices from "@/Pages/User/Components/Tabs/SpecializedServices.vue";

onMounted(() => {
  initFlowbite();
});

const props = defineProps({
  user: Object,
  acting: Object,
});
</script>
