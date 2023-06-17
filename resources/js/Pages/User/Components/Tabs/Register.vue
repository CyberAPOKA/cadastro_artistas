<template>
  <Form @submit="submit" class="space-y-6" enctype="multipart/form-data">
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
          >Inscrição Estadual</label
        >
        <Field
          type="text"
          id="state_registration"
          name="state_registration"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.state_registration"
        >
        </Field>
      </div>
      <div>
        <label
          for="municipal_registration"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Inscrição Municipal</label
        >
        <Field
          type="text"
          id="municipal_registration"
          name="municipal_registration"
          placeholder=" "
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="form.municipal_registration"
        >
        </Field>
      </div>

      <div>
        <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Pessoa Jurídica (CNPJ/MEI) ou Pessoa Física (CPF)?<span class="text-red-600"
            >*</span
          >
        </div>
        <div class="flex items-center mb-4">
          <Field
            id="cnpj"
            type="radio"
            value="cnpj"
            name="document"
            v-model="selectedDocument"
            @change="clearInputText"
            :rules="isRadioSelected"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
          />

          <label
            for="cnpj"
            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
            >Pessoa Jurídica (CNPJ/MEI)</label
          >
        </div>
        <div class="flex items-center">
          <Field
            id="cpf"
            type="radio"
            value="cpf"
            name="document"
            v-model="selectedDocument"
            @change="clearInputText"
            :rules="isRadioSelected"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
          />
          <label
            for="cpf"
            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
            >Pessoa Física (CPF)</label
          >
        </div>
        <ErrorMessage name="document" />
        <div v-show="selectedDocument === 'cnpj'" class="pt-4">
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
        <div v-show="selectedDocument === 'cpf'" class="pt-4">
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
              checked
              id="no"
              type="radio"
              name="pcd"
              v-on:change="showPcd = false"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            />
            <label
              for="no"
              class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
              >Não</label
            >
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
          placeholder="Digite para pesquisar..."
          required
        />
      </div>
      <ErrorMessage name="acting" />
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
          >Faço parte da REDE FILM FRIENDLY</label
        >

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

      <div>
        <div>
          <label
            for="clip"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Clipagem: comprovação do trabalho</label
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

          <!-- <ErrorMessage name="clipping" /> -->
        </div>
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <InputLabel
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="file_input"
          >Currículo<span class="text-red-600">*</span></InputLabel
        >

        <Field
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
          aria-describedby="file_input_help"
          id="file_input_curriculum"
          name="file_input_curriculum"
          type="file"
          @change="onFileSelect('curriculum', $event)"
          accept=".pdf"
          v-model="form.curriculum"
          :rules="isRequired"
        />
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
          PDF (1 Arquivo, Tamanho máximo 3MB).
        </p>
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <InputLabel
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="file_input"
          >Comprovante de residência<span class="text-red-600">*</span></InputLabel
        >

        <Field
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
          aria-describedby="file_input_help"
          id="file_input_proof_of_address"
          name="file_input_proof_of_address"
          type="file"
          @change="onFileSelect('proof_of_address', $event)"
          accept=".pdf"
          v-model="form.proof_of_address"
          :rules="isRequired"
        />
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
          PDF (1 Arquivo, Tamanho máximo 3MB).
        </p>
      </div>

      <div class="relative z-0 w-full mb-6 group">
        <InputLabel
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="file_input_rg_front"
          >Cópia do RG (FRENTE)<span class="text-red-600">*</span></InputLabel
        >

        <Field
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
          aria-describedby="file_input_help"
          id="file_input_rg_front"
          name="file_input_rg_front"
          type="file"
          @change="onRgSelect('rg_front', $event)"
          v-model="form.rg_front"
          :rules="isRequired"
        />
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
          PDF (1 Arquivo, Tamanho máximo 3MB).
        </p>
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <InputLabel
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="file_input_rg_back"
          >Cópia do RG (VERSO)<span class="text-red-600">*</span></InputLabel
        >

        <Field
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
          aria-describedby="file_input_help"
          id="file_input_rg_back"
          name="file_input_rg_back"
          type="file"
          @change="onRgSelect('rg_back', $event)"
          :rules="isRequired"
          v-model="form.rg_back"
        />
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
          PDF (1 Arquivo, Tamanho máximo 3MB).
        </p>
      </div>
      <div class="relative z-0 w-full mb-6 group"></div>
      <div class="relative z-0 w-full mb-6 group">
        <div class="flex items-start mb-6">
          <div class="flex items-center h-5">
            <input
              id="remember"
              type="checkbox"
              value=""
              class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
            />
          </div>
          <label
            for="remember"
            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
            >I agree with the
            <a href="#" class="text-blue-600 hover:underline dark:text-blue-500"
              >terms and conditions</a
            >.</label
          >
        </div>
        <button
          type="submit"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          :disabled="
            validateFullName(form.name) !== true ||
            isRequired(form.address) !== true ||
            isRequired(form.neighborhood) !== true ||
            isRequired(form.city) !== true ||
            isRequired(form.phone) !== true ||
            isRadioSelected(selectedDocument) !== true ||
            isRequiredCNPJ(form.cnpj) !== true ||
            isRequiredCPF(form.cpf) !== true ||
            form.acting.length === 0 ||
            form.gender.length === 0 ||
            form.race.length === 0 ||
            isRequired(form.curriculum) !== true ||
            isRequired(form.proof_of_address) !== true ||
            isRequired(form.rg_front) !== true ||
            isRequired(form.rg_back) !== true
          "
        >
          Registrar
        </button>
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <div class="flex">
          <h3 class="text-white">name:</h3>
          <span class="text-red-500"> {{ validateFullName(form.name) }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">address:</h3>
          <span class="text-red-500"> {{ isRequired(form.address) }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">neighborhood:</h3>
          <span class="text-red-500"> {{ isRequired(form.neighborhood) }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">isRadioSelected(selectedDocument):</h3>
          <span class="text-red-500"> {{ isRadioSelected(selectedDocument) }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">isRequiredCNPJ(form.cnpj):</h3>
          <span class="text-red-500"> {{ isRequiredCNPJ(form.cnpj) }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">isRequiredCPF(form.cpf):</h3>
          <span class="text-red-500"> {{ isRequiredCPF(form.cpf) }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">form.acting.length:</h3>
          <span class="text-red-500"> {{ form.acting.length }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">form.gender.length:</h3>
          <span class="text-red-500"> {{ form.gender.length }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">form.race.length :</h3>
          <span class="text-red-500"> {{ form.race.length }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">curriculum:</h3>
          <span class="text-red-500"> {{ isRequired(form.curriculum) }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">proof_of_address:</h3>
          <span class="text-red-500"> {{ isRequired(form.proof_of_address) }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">rg_front:</h3>
          <span class="text-red-500"> {{ isRequired(form.rg_front) }}</span>
        </div>
        <div class="flex">
          <h3 class="text-white">rg_back:</h3>
          <span class="text-red-500"> {{ isRequired(form.rg_back) }}</span>
        </div>
      </div>
      <div class="relative z-0 w-full mb-6 group">
        <div class="text-white">CPFS REGISTRADOS</div>
        <br />
        <div class="text-green-400">{{ cpfs }}</div>
      </div>
    </div>

    <!-- form.proof_of_address === '' ||
        form.rg_front === '' ||
        form.rg_back === '' -->
    <!-- 
      validateFullName(form.name) != true ||
        isRequired(form.address) != true ||
        isRequired(form.neighborhood) != true ||
        isRequired(form.city) != true ||
        validateCEP(form.zip_code) != true ||
        isRequired(form.state_registration) != true ||
        isRequired(form.municipal_registration) != true ||
        isRequiredCNPJ(form.cnpj) != true ||
        isRequiredCPF(form.cpf) != true ||
        form.acting.length === 0 ||
        form.gender.length === 0 ||
        form.race.length === 0 ||
        !form.curriculum ||
        !form.proof_of_address ||
        !form.rg_front ||
        !form.rg_back 
        -->
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
  validateFullName,
  onRgSelect,
} from "@/Pages/Validation/validation.js";

const props = defineProps({
  cpfs: Array,
});

const defaultClip = { value: "" };

const form = useForm({
  name: "",
  representative: "",
  address: "",
  neighborhood: "",
  city: "",
  zip_code: "",
  state_registration: "",
  municipal_registration: "",
  cnpj: "",
  cpf: "",
  phone: "",
  gender: "",
  race: "",
  pcd: "",
  website: "",
  acting: "",
  film_friendly_network: "",
  clips: [defaultClip],
  curriculum: "",
  proof_of_address: "",
  rg_front: "",
  rg_back: "",
});

let showPcd = ref(false);

let selectedDocument = ref(null);

const showSelect = ref(false);

const resetSelect = () => {
  if (!showSelect.value) {
    form.film_friendly_network = "";
  }
};

function clearInputText() {
  if (selectedDocument.value === "cnpj") {
    form.cpf = "";
  } else if (selectedDocument.value === "cpf") {
    form.cnpj = "";
  }
}

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

function isRequiredCNPJ(value) {
  if (selectedDocument.value === "cnpj" && !value) {
    return "O campo CNPJ é obrigatório!";
  }
  return true;
}

async function validateCEP(value) {
  if (!value) {
    return "Este campo é obrigatório!";
  }

  value = value.replace(/\D/g, "");

  const regex = /^[0-9]{8}$/;
  if (!regex.test(value)) {
    return "Este campo deve ser um CEP válido!";
  }
  const response = await fetch(`https://viacep.com.br/ws/${value}/json/`);
  const data = await response.json();
  if (data.erro) {
    return "Este CEP não existe";
  }
  return true;
}

function isRequiredCPF(value) {
  if (selectedDocument.value === "cpf" && !value) {
    return "O campo CPF é obrigatório!";
  }
  value = value.replace(/[^0-9]/g, "");

  if (selectedDocument.value === "cpf" && value.length !== 11) {
    return "Este campo deve ter 11 dígitos!";
  }

  if (selectedDocument.value === "cpf" && value === "00000000000") return "CPF inválido";

  let Soma;
  let Resto;
  Soma = 0;

  for (let i = 1; i <= 9; i++) Soma += parseInt(value.substring(i - 1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

  if (Resto === 10 || Resto === 11) Resto = 0;
  if (selectedDocument.value === "cpf" && Resto !== parseInt(value.substring(9, 10)))
    return "CPF inválido";

  Soma = 0;

  for (let i = 1; i <= 10; i++) Soma += parseInt(value.substring(i - 1, i)) * (12 - i);
  Resto = (Soma * 10) % 11;

  if (Resto === 10 || Resto === 11) Resto = 0;
  if (selectedDocument.value === "cpf" && Resto !== parseInt(value.substring(10, 11)))
    return "CPF inválido";

  if (selectedDocument.value === "cpf") {
    const cpf = value.replace(/[^0-9]/g, "");

    for (let i = 0; i < props.cpfs.length; i++) {
      if (props.cpfs[i] && props.cpfs[i].replace(/[^0-9]/g, "") === cpf) {
        return "Este CPF já existe!";
      }
    }
  }

  return true;
}

const isRadioSelected = (value) => {
  if (!value) {
    return "Você deve selecionar uma opção";
  }
  return true;
};

const getActingsOptions = async () => {
  const response = await axios.get("/api/actings");
  const actings = response.data.actings.map((a) => ({
    label: a.acting,
    value: a.id,
  }));
  return actings;
};

const options = ref([]);

onMounted(async () => {
  options.value = await getActingsOptions();
  options.value.sort((a, b) => a.label.localeCompare(b.label));
});

function addClip() {
  form.clips.push({ ...defaultClip });
}

function removeClip(index) {
  form.clips.splice(index, 1);
}

const submit = () => {
  form.post(route("register.profile"), {
    headers: {
      "Content-Type": "multipart/form-data",
    },
  });
  // location.reload();
  window.location.reload();
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
