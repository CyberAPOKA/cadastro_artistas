<template>
  <Form
    @submit="submit"
    class="space-y-6 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 container mx-auto mb-8"
    enctype="multipart/form-data"
  >
    <div class="grid gap-6 mb-6 md:grid-cols-2">
      <div>
        <label
          for="name"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Nome da Empresa, Entidade ou do Profissional
          <span class="text-red-600">*</span></label
        >
        <Field
          type="text"
          id="name"
          name="name"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.name"
          :rules="validateFullName"
        >
        </Field>
        <ErrorMessage name="name" />
      </div>
      <div>
        <label
          for="representative"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Representante legal da Empresa ou Entidade</label
        >
        <Field
          type="text"
          id="representative"
          name="representative"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.representative"
        >
        </Field>
        <ErrorMessage name="representative" />
      </div>
      <div>
        <div v-if="user.profile?.cnpj">
          <label
            for="cnpj"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >CNPJ <span class="text-red-600">*</span></label
          >
          <Field
            type="text"
            id="cnpj"
            name="cnpj"
            placeholder=" "
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            v-model="form.cnpj"
            v-mask="['##.###.###/####-##']"
            :rules="isRequiredCNPJ"
          >
          </Field>
          <ErrorMessage name="cnpj" />
        </div>
        <div v-if="user.profile?.cpf">
          <label
            for="cpf"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >CPF <span class="text-red-600">*</span></label
          >
          <Field
            type="text"
            id="cpf"
            name="cpf"
            placeholder=" "
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            v-model="form.cpf"
            v-mask="['###.###.###-##']"
            :rules="isRequiredCPF"
          >
          </Field>
          <ErrorMessage name="cpf" />
        </div>
      </div>
      <div>
        <label
          for="phone"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Telefone <span class="text-red-600">*</span></label
        >
        <Field
          type="phone"
          id="phone"
          name="phone"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.phone"
          v-mask="['(##) ####-####', '(##) #####-####']"
          :rules="isRequired"
        >
        </Field>
        <ErrorMessage name="phone" />
      </div>

      <div>
        <label
          for="gender"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Gênero<span class="text-red-600">*</span></label
        >
        <select
          id="gender"
          name="gender"
          v-model="form.gender"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
          <option value="" selected>Selecione seu Gênero</option>
          <option value="Feminino (cisgênero)">Feminino (cisgênero)</option>
          <option value="Masculino (cisgênero)">Masculino (cisgênero)</option>
          <option value="Transgênero Feminino">Transgênero Feminino</option>
          <option value="Transgênero Masculino">Transgênero Masculino</option>
          <option value="Não Binário">Não Binário</option>
        </select>
      </div>

      <div>
        <label
          for="race"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Cor/Etnia<span class="text-red-600">*</span></label
        >
        <select
          id="race"
          name="race"
          v-model="form.race"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
          <option value="" selected>Selecione sua Cor/Etnia</option>
          <option value="Amarela">Amarela</option>
          <option value="Branca">Branca</option>
          <option value="Preta">Preta</option>
          <option value="Parda">Parda</option>
          <option value="Indígenas">Indígenas</option>
        </select>
      </div>

      <div>
        <label
          for="race"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Pessoa Com Deficiência</label
        >

        <div class="flex">
          <div class="items-center">
            <input
              id="yes"
              type="radio"
              name="pcd"
              v-on:change="showPcd = true"
              v-bind:checked="form.pcd !== null"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            />
            <label
              for="yes"
              class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
              >Sim</label
            >
          </div>
          <div class="items-center pl-2">
            <input
              id="no"
              type="radio"
              name="pcd"
              v-on:change="showPcd = false"
              v-bind:checked="form.pcd === null"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            />
            <label
              for="no"
              class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
              >Não
            </label>
          </div>
        </div>
        <div v-if="showPcd" class="pt-2">
          <label
            for="representative"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Qual</label
          >
          <Field
            type="text"
            id="input-pcd"
            name="input-pcd"
            placeholder=" "
            v-model="form.pcd"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
          </Field>
        </div>
      </div>
      <div>
        <label
          for="website"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Website</label
        >
        <Field
          type="text"
          id="website"
          name="website"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.website"
        >
        </Field>
        <ErrorMessage name="website" />
      </div>
      <div>
        <label
          for="acting"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Qual é seu ramo de atuação?<span class="text-red-600">*</span></label
        >
        <Multiselect
          :classes="{
            container:
              'relative mx-auto w-full flex items-center justify-end box-border cursor-pointer border border-gray-300 rounded bg-white text-base leading-snug outline-none',
            containerDisabled: 'cursor-default bg-gray-100',
            containerOpen: 'rounded-b-none',
            containerOpenTop: 'rounded-t-none',
            containerActive: 'ring ring-gray-500 ring-opacity-30',
            singleLabel:
              'flex text-white items-center h-full max-w-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 pr-16 box-border rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
            singleLabelText:
              'overflow-ellipsis overflow-hidden block whitespace-nowrap max-w-full text-white',
            multipleLabel:
              'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
            search:
              'w-full text-green-500 absolute inset-0 outline-none focus:ring-0 appearance-none box-border border-0 text-base font-sans bg-gray-700 rounded pl-3.5 rtl:pl-0 rtl:pr-3.5',
            tags:
              'flex-grow flex-shrink flex flex-wrap items-center mt-1 pl-2 rtl:pl-0 rtl:pr-2',
            tag:
              'bg-gray-500 text-gray-900  text-sm font-semibold py-0.5 pl-2 rounded mr-1 mb-1 flex items-center whitespace-nowrap rtl:pl-0 rtl:pr-2 rtl:mr-0 rtl:ml-1',
            tagDisabled: 'pr-2 opacity-50 rtl:pl-2',
            tagRemove:
              'flex items-center justify-center p-1 mx-0.5 rounded-sm hover:bg-black hover:bg-opacity-10 group',
            tagRemoveIcon:
              'bg-multiselect-remove bg-center bg-no-repeat opacity-30 inline-block w-3 h-3 group-hover:opacity-60',
            tagsSearchWrapper:
              'inline-block relative mx-1 mb-1 flex-grow flex-shrink h-full',
            tagsSearch:
              'absolute inset-0 border-0 outline-none focus:ring-0 appearance-none p-0 text-base font-sans box-border w-full',
            tagsSearchCopy: 'invisible whitespace-pre-wrap inline-block h-px',
            placeholder:
              'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 text-gray-400 rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
            caret:
              'bg-multiselect-caret bg-center bg-no-repeat w-2.5 h-4 py-px box-content mr-3.5 relative z-10 opacity-40 flex-shrink-0 flex-grow-0 transition-transform transform pointer-events-none rtl:mr-0 rtl:ml-3.5',
            caretOpen: 'rotate-180 pointer-events-auto',
            clear:
              'pr-3.5 relative z-10 opacity-40 transition duration-300 flex-shrink-0 flex-grow-0 flex hover:opacity-80 rtl:pr-0 rtl:pl-3.5',
            clearIcon:
              'bg-multiselect-remove bg-center bg-no-repeat w-2.5 h-4 py-px box-content inline-block',
            spinner:
              'bg-multiselect-spinner bg-center bg-no-repeat w-4 h-4 z-10 mr-3.5 animate-spin flex-shrink-0 flex-grow-0 rtl:mr-0 rtl:ml-3.5',
            inifite: 'flex items-center justify-center w-full',
            inifiteSpinner:
              'bg-multiselect-spinner bg-center bg-no-repeat w-4 h-4 z-10 animate-spin flex-shrink-0 flex-grow-0 m-3.5',
            dropdown:
              'max-h-60 absolute -left-px -right-px bottom-0 transform translate-y-full border border-gray-300 -mt-px overflow-y-scroll z-50 bg-gray-700 flex flex-col rounded-b',
            dropdownTop: '-translate-y-full top-px bottom-auto rounded-b-none rounded-t',
            dropdownHidden: 'hidden',
            options: 'flex flex-col p-0 m-0 list-none',
            optionsTop: '',
            group: 'p-0 m-0',
            groupLabel:
              'flex text-sm box-border items-center justify-start text-left py-1 px-3 font-semibold bg-gray-200 cursor-default leading-normal',
            groupLabelPointable: 'cursor-pointer',
            groupLabelPointed: 'bg-gray-300 text-gray-700',
            groupLabelSelected: 'bg-gray-600 text-gray-900 ',
            groupLabelDisabled: 'bg-gray-100 text-gray-300 cursor-not-allowed',
            groupLabelSelectedPointed: 'bg-gray-600 text-gray-900  opacity-90',
            groupLabelSelectedDisabled:
              'text-gray-100 bg-gray-600 bg-opacity-50 cursor-not-allowed',
            groupOptions: 'p-0 m-0',
            option:
              'flex text-white items-center justify-start box-border text-left cursor-pointer text-base leading-snug py-2 px-3',
            optionPointed: 'text-gray-800 bg-blue-600',
            optionSelected: 'text-gray-900 bg-gray-500',
            optionDisabled: 'text-gray-300 cursor-not-allowed',
            optionSelectedPointed: 'text-gray-900  bg-gray-500 opacity-90',
            optionSelectedDisabled:
              'text-gray-100 bg-gray-500 bg-opacity-50 cursor-not-allowed',
            noOptions: 'py-2 px-3 text-gray-600 text-gray-900  text-left',
            noResults: 'py-2 px-3 text-gray-600 text-gray-900  text-left',
            fakeInput:
              'bg-transparent absolute left-0 right-0 -bottom-px w-full h-px border-0 p-0 appearance-none outline-none text-transparent',
            spacer: 'h-9 py-px box-content',
          }"
          v-model="form.acting"
          :close-on-select="true"
          :searchable="true"
          :create-option="false"
          :options="options"
          :placeholder="form.acting.toString()"
          :rules="isRequired"
          id="acting"
          name="acting"
        />
        <ErrorMessage name="acting" />
      </div>
      <div>
        <input
          id="checkbox_film_friendly_network"
          type="checkbox"
          v-model="showSelect"
          v-on:change="resetSelect"
          class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
        />
        <label
          for="checkbox_film_friendly_network"
          class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
          >Faço parte da REDE FILM FRIENDLY
        </label>

        <div v-if="showSelect">
          <label
            for="film_friendly_network"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white pt-6"
            >Categoria do receptivo local</label
          >
          <select
            id="film_friendly_network"
            name="film_friendly_network"
            v-model="form.film_friendly_network"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <option value="" selected>Clique para selecionar</option>
            <option value="Gastronomia">Gastronomia</option>
            <option value="Hotelaria">Hotelaria</option>
            <option value="Transporte">Transporte</option>
            <option value="Entidades e empresas parceiras">
              Entidades e empresas parceiras
            </option>
          </select>
        </div>
      </div>
    </div>
    <button
      type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      :disabled="
        validateFullName(form.name) !== true ||
        isRequired(form.phone) !== true ||
        (user.profile.cnpj && isRequiredCNPJ(form.cnpj) !== true) ||
        (user.profile.cpf && isRequiredCPF(form.cpf) !== true) ||
        form.acting.length === 0 ||
        form.gender.length === 0 ||
        form.race.length === 0
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
import {
  isRequired,
  validateFullName
} from "@/Pages/Validation/validation.js";

const props = defineProps({
  user: Object,
  cpfs: Array,
});

const form = useForm({
  name: props.user.profile.name,
  representative: props.user.profile.representative,
  cnpj: props.user.profile.cnpj,
  cpf: props.user.profile.cpf,
  phone: props.user.profile.phone,
  gender: props.user.profile.gender,
  race: props.user.profile.race,
  pcd: props.user.profile.pcd,
  website: props.user.profile.website,
  acting: Array.isArray(props.user.actings)
    ? props.user.actings[0].acting.id
    : props.user.actings.acting.id,

  film_friendly_network: props.user.profile.film_friendly_network,
});

let showPcd = ref(false);

if (form.pcd !== null) {
  showPcd = ref(true);
}

const selectedDocument = ref(null);

let initialShowSelect = true;

if (form.film_friendly_network == null) {
  initialShowSelect = false;
}

const showSelect = ref(initialShowSelect);

const resetSelect = () => {
  if (!showSelect.value) {
    form.film_friendly_network = "";
  }
};

function isRequiredCNPJ(value) {
  if (props.user.profile.cnpj !== "" && !value) {
    return "O campo CNPJ é obrigatório!";
  }
  return true;
}

function isRequiredCPF(value) {
  if (props.user.profile.cpf !== "" && !value) {
    return "O campo CPF é obrigatório!";
  }
  value = value.replace(/[^0-9]/g, "");

  if (props.user.profile.cpf !== "" && value.length !== 11) {
    return "Este campo deve ter 11 dígitos!";
  }

  if (props.user.profile.cpf !== "" && value === "00000000000") return "CPF inválido";

  let Soma;
  let Resto;
  Soma = 0;

  for (let i = 1; i <= 9; i++) Soma += parseInt(value.substring(i - 1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

  if (Resto === 10 || Resto === 11) Resto = 0;
  if (props.user.profile.cpf !== "" && Resto !== parseInt(value.substring(9, 10)))
    return "CPF inválido";

  Soma = 0;

  for (let i = 1; i <= 10; i++) Soma += parseInt(value.substring(i - 1, i)) * (12 - i);
  Resto = (Soma * 10) % 11;

  if (Resto === 10 || Resto === 11) Resto = 0;
  if (props.user.profile.cpf !== "" && Resto !== parseInt(value.substring(10, 11)))
    return "CPF inválido";

  return true;
}

const getActingsOptions = async () => {
  const response = await axios.get("/api/actings");
  const actings = response.data.actings.map((a) => ({
    label: a.acting,
    value: a.id,
  }));
  return actings;
};

const options = ref([]);

// onMounted(async () => {
//   options.value = await getActingsOptions();
// });

onMounted(async () => {
  options.value = await getActingsOptions();
});

const submit = () => {
  event.preventDefault();
  form.post(route("update.profile"), {
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
