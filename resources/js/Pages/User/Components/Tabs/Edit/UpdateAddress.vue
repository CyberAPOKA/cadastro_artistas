<template>
  <Form
    @submit="submit"
    class="space-y-6 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 container mx-auto mb-8"
  >
    <div class="grid gap-6 mb-6 md:grid-cols-2">
      <div>
        <label
          for="address"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Endereço <span class="text-red-600">*</span></label
        >
        <Field
          type="text"
          id="address"
          name="address"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.address"
          :rules="isRequired"
        >
        </Field>
        <ErrorMessage name="address" />
      </div>
      <div>
        <label
          for="neighborhood"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Bairro <span class="text-red-600">*</span></label
        >
        <Field
          type="text"
          id="neighborhood"
          name="neighborhood"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.neighborhood"
          :rules="isRequired"
        >
        </Field>
        <ErrorMessage name="neighborhood" />
      </div>
      <div>
        <label
          for="city"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Cidade <span class="text-red-600">*</span></label
        >
        <Field
          type="text"
          id="city"
          name="city"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.city"
          :rules="isRequired"
        >
        </Field>
        <ErrorMessage name="city" />
      </div>
      <div>
        <label
          for="zip_code"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >CEP <span class="text-red-600">*</span></label
        >
        <Field
          type="text"
          id="zip_code"
          name="zip_code"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.zip_code"
          :rules="validateCEP"
          v-mask="['#####-###']"
        >
        </Field>
        <ErrorMessage name="zip_code" />
      </div>
      <div>
        <label
          for="state_registration"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Inscrição Estadual
        </label>
        <Field
          type="text"
          id="state_registration"
          name="state_registration"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.state_registration"
        >
        </Field>
        <ErrorMessage name="state_registration" />
      </div>
      <div>
        <label
          for="municipal_registration"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Inscrição Municipal
        </label>
        <Field
          type="text"
          id="municipal_registration"
          name="municipal_registration"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.municipal_registration"
        >
        </Field>
        <ErrorMessage name="municipal_registration" />
      </div>
    </div>
    <button
      type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      :disabled="
        isRequired(form.address) !== true ||
        isRequired(form.neighborhood) !== true ||
        isRequired(form.city) !== true
      "
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
import {
  isRequired,
  validateCEP
} from "@/Pages/Validation/validation.js";

const props = defineProps({
  user: Object,
  cpfs: Array,
});

const form = useForm({
  address: props.user.address.address,
  neighborhood: props.user.address.neighborhood,
  city: props.user.address.city,
  zip_code: props.user.address.zip_code,
  state_registration: props.user.address.state_registration,
  municipal_registration: props.user.address.municipal_registration,
});

const submit = () => {
  // event.preventDefault();
  form.post(route("update.address"), {
    preserveScroll: true,
  });
};
</script>
<script>
import { mask } from "vue-the-mask";
export default {
  directives: { mask },
};
</script>
<style>
span[role="alert"] {
  color: red;
}
</style>
