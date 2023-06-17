<template>
  <Form
    @submit="submit"
    class="space-y-6 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 container mx-auto mb-8"
  >
    <div class="grid gap-6 mb-6 md:grid-cols-2">
      <div class="relative z-0 w-full mb-6 group">
        <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Clipagens atuais
        </div>
        <div class="relative overflow-x-auto py-4">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead
              class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
              <tr>
                <th scope="col" class="px-6 py-3">Clipagem</th>
                <th scope="col" class="px-6 py-3">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                v-for="clip in user.clippings"
                :key="clip.id"
              >
                <th
                  scope="row"
                  class="w-2/4 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >
                  {{ clip.clipping }}
                </th>
                <td class="px-6 py-4 flex justify-between">
                  <!-- <EditClip></EditClip> -->

                  <button type="button" @click="deleteClip(clip.id)">
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
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div>
        <label
          for="clip"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Adicionar novas clipagens</label
        >
        <div>
          <div v-for="(clip, index) in form.clips" :key="index">
            <div class="flex">
              <Field
                type="text"
                :id="'clip-' + index"
                :name="'clip-' + index"
                placeholder=" "
                v-model="clip.value"
                class="my-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              />
              <button
                type="button"
                @click="removeClip(index)"
                v-if="index > 0"
                class="my-1 mx-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
              >
                Remover
              </button>
            </div>
          </div>
          <button
            type="button"
            @click="addClip"
            class="my-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            Adicionar mais uma clipagem
          </button>
        </div>
        <button
          type="submit"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
          Salvar
        </button>
      </div>
    </div>
  </Form>
</template>
<script setup>
import { Field, Form } from "vee-validate";
import { useForm } from "@inertiajs/vue3";
import EditClip from "./EditClip.vue";

const props = defineProps({
  user: Object,
  cpfs: Array,
});

const defaultClip = { value: "" };

const form = useForm({
  clips: [defaultClip],
});

function addClip() {
  form.clips.push({ ...defaultClip });
}

function removeClip(index) {
  form.clips.splice(index, 1);
}

const submit = () => {
  event.preventDefault();
  form.post(route("update.clip"), {
    preserveScroll: true,
  });
};

const deleteClip = (id) => {
  form.post(route("delete.clip", { id: id }), {
    preserveScroll: true,
  });
};
</script>
<style>
span[role="alert"] {
  color: red;
}
</style>
