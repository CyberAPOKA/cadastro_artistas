<template>
  <footer class="bg-white dark:bg-gray-900">
    <div class="mx-auto w-full max-w-screen-xl">
      <div class="grid grid-cols-1 gap-8 px-4 py-6 lg:py-8 md:grid-cols-2">
        <div>
          <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
            Informações
          </h2>
          <ul class="text-gray-500 dark:text-gray-400 font-medium">
            <li class="mb-4">
              <p>Cadastro Municipal da Cultura: Logístico, Técnico e Artístico</p>
            </li>
            <li class="mb-4">
              <p>
                Secretaria Municipal de Cultura e Relações Internacionais de São Leopoldo
              </p>
            </li>
            <li class="mb-4">
              <p>Endereço: Rua Osvaldo Aranha, 934 – Centro</p>
            </li>
          </ul>
        </div>

        <div>
          <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
            Contato
          </h2>
          <ul class="text-gray-500 dark:text-gray-400 font-medium">
            <li class="mb-4">
              <p>Telefone: (51) 2200 - 0522/ (51) 2200- 0529</p>
            </li>
            <li class="mb-4">
              <p>E-mail: cultura@saoleopoldo.rs.gov.br</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</template>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";

onMounted(() => {
  initFlowbite();
});
</script>
