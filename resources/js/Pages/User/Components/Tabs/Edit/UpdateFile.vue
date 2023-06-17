<template>
  <Form
    @submit="submit"
    class="space-y-6 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 container mx-auto mb-8"
    enctype="multipart/form-data"
  >
    <div class="relative z-0 w-full mb-6 group">
      <div class="relative overflow-x-auto py-4">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <th scope="col" class="px-6 py-3">Arquivo atual</th>
              <th scope="col" class="px-6 py-3">Substituir por</th>
              <th scope="col" class="px-6 py-3">Tipo</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
              v-for="file in user.files"
              :key="file.id"
            >
              <th
                scope="row"
                class="w-2/4 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ file.name }}
              </th>
              <td class="px-6 py-4">
                <input
                  class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                  type="file"
                  @change="onFileSelect(file.type, $event)"
                  accept=".pdf"
                />
              </td>
              <td class="px-6 py-4">
                {{ fileType[file.type] }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <button
      type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    >
      Salvar
    </button>
  </Form>
</template>
<script setup>
import { Field, Form, ErrorMessage } from "vee-validate";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed } from "@vue/reactivity";
import { ref, onMounted } from "vue";
import axios from "axios";
import Multiselect from "@vueform/multiselect";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
  user: Object,
  cpfs: Array,
});

const fileType = {
  curriculum: "Currículo",
  proof_of_address: "Comprovante de residência",
  rg_front: "RG Frente",
  rg_back: "RG Verso",
};

function onFileSelect(field, event) {
  const files = event.target.files;
  if (files.length === 1) {
    const file = files[0];
    if (file.type === "application/pdf") {
      if (file.size <= 3 * 1024 * 1024) {
        //3MB
        form[field] = file;
      } else {
        event.target.value = null;
        alert("O arquivo deve ter no máximo 3MB.");
      }
    } else {
      event.target.value = null;
      alert("Por favor, selecione um arquivo PDF.");
    }
  } else {
    event.target.value = null;
    alert("1 Arquivo no máximo.");
  }
}

const form = useForm({
  _method: "POST",
  curriculum: null,
  proof_of_address: null,
  rg_front: null,
  rg_back: null,
});

const submit = () => {
  event.preventDefault();
  form.post(route("update.file"), {
    preserveScroll: true,
  });
};
</script>
