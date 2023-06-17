<template>
  <Sidebar></Sidebar>

  <div class="p-4 sm:ml-64">
    <div
      class="p-4 my-10 mx-10 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
    >
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <th
                scope="col"
                class="px-6 py-3 text-sm font-medium text-gray-900 dark:text-white"
              >
                ID
              </th>
              <th scope="col" class="px-6 py-3">
                <label
                  for="email"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >E-mail</label
                >
                <input
                  type="text"
                  id="email"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Pesquisar"
                  v-model="searchEmail"
                />
              </th>
              <th scope="col" class="px-6 py-3">
                <label
                  for="name"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Nome</label
                >
                <input
                  type="text"
                  id="name"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Pesquisar"
                  v-model="searchName"
                />
              </th>
              <th scope="col" class="px-6 py-3">
                <label
                  for="city"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Cidade</label
                >
                <input
                  type="text"
                  id="city"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Pesquisar"
                  v-model="searchCity"
                />
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
              v-for="(user, index) in users.data"
              :key="user.id"
              :users="users"
              :index="index"
            >
              <td class="px-6 py-4">
                <Link
                  :href="'admin/user/' + user.id"
                  class="font-medium text-gray-900 whitespace-nowrap dark:text-blue-400"
                >
                  {{ user.id }}
                </Link>
              </td>
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ user.email }}
              </th>
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ user.profile?.name }}
              </th>
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ user.address?.city }}
              </th>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="pl-5 pt-6 text-center">
        <TailwindPagination
          :data="users"
          :filters="filters"
          @pagination-change-page="(page) => getUsers(page, filters)"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import Sidebar from "@/Pages/Admin/Layout/Sidebar.vue";
import { TailwindPagination } from "laravel-vue-pagination";
import { ref, watchEffect, reactive, onMounted } from "vue";
import { createStore } from "vuex";
import { Link } from "@inertiajs/vue3";

const users = ref({ data: [] });
const searchEmail = ref(null);
const searchName = ref(null);
const searchCity = ref(null);

const filters = reactive({
  email: "",
  name: "",
  city: "",
});

const store = createStore({
  state: {
    filters: {
      email: "",
      name: "",
      city: "",
    },
  },
  mutations: {
    setFilters(state, filters) {
      state.filters = filters;
    },
  },
});

const getUsers = (page = 1, filters = store.state.filters) => {
  axios
    .get(`/api/users?page=${page}`, {
      params: filters,
    })
    .then((response) => {
      users.value = response.data.users;
    });
};

onMounted(() => {
  searchEmail.value = "";
  searchName.value = "";
  searchCity.value = "";
});

watchEffect(() => {
  filters.email = searchEmail.value;
  filters.name = searchName.value;
  filters.city = searchCity.value;
  store.commit("setFilters", filters);
  getUsers();
});
</script>
