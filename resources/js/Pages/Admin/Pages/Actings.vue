<template>
  <Sidebar></Sidebar>

  <div class="p-4 sm:ml-64">
    <div
      class="p-4 my-10 mx-10 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
    >
      <CreateActing></CreateActing>

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
                  for="acting"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Ramo</label
                >
                <input
                  type="text"
                  id="acting"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Pesquisar"
                  v-model="searchActing"
                />
              </th>
              <th
                scope="col"
                class="px-6 py-3 text-sm font-medium text-gray-900 dark:text-white"
              >
                Ações
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
              v-for="(acting, index) in actings.data"
              :key="acting.id"
              :actings="actings"
              :index="index"
            >
              <td
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-blue-400"
              >
                {{ acting.id }}
              </td>
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ acting.acting }}
              </th>
              <td
                class="px-6 py-4 font-medium text-gray-900 dark:text-white flex justify-between"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                  />
                </svg>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                  />
                </svg>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="pl-5 pt-6 text-center">
        <TailwindPagination
          :data="actings"
          :filters="filters"
          @pagination-change-page="(page) => getActings(page, filters)"
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
import { Field, Form, ErrorMessage } from "vee-validate";
import { isRequired } from "@/Pages/Validation/validation.js";
import { Head, Link, useForm } from "@inertiajs/vue3";
import CreateActing from "@/Pages/Admin/Pages/Components/CreateActing.vue";

const actings = ref({ data: [] });
const searchActing = ref(null);

const filters = reactive({
  acting: "",
});

const store = createStore({
  state: {
    filters: {
      acting: "",
    },
  },
  mutations: {
    setFilters(state, filters) {
      state.filters = filters;
    },
  },
});

const getActings = (page = 1, filters = store.state.filters) => {
  axios
    .get(`/api/admin/actings?page=${page}`, {
      params: filters,
    })
    .then((response) => {
      actings.value = response.data.actings;
    });
};

onMounted(() => {
  searchActing.value = "";
});

watchEffect(() => {
  filters.acting = searchActing.value;
  store.commit("setFilters", filters);
  getActings();
});
</script>
<style>
span[role="alert"] {
  color: red;
}
</style>
