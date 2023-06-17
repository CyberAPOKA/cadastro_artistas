<template>
  <div class="text-white text-5xl">Serviços logísticos</div>
  <div class="grid grid-cols-4 gap-4 py-6 text-white">
    <div v-for="(group, letter) in groupedLogistics" :key="letter">
      <div class="text-2xl font-bold">{{ letter }}</div>
      <div v-for="(item, index) in group" :key="index">
        <a v-if="item.users_count > 0" :href="'/servico/logistico/' + item.id"
          >{{ item.acting }} ({{ item.users_count }})</a
        >
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";

const logistics = ref([]);
const groupedLogistics = ref({});

onMounted(async () => {
  const response = await fetch("/api/logistics");
  const data = await response.json();
  logistics.value = data.logistics;

  for (const item of logistics.value) {
    const letter = item.acting.charAt(0).toUpperCase();
    if (!groupedLogistics.value[letter]) {
      groupedLogistics.value[letter] = [];
    }
    groupedLogistics.value[letter].push(item);
  }
});

const sortedKeys = Object.keys(groupedLogistics.value).sort();
groupedLogistics.value = Object.fromEntries(
  sortedKeys.map((key) => [key, groupedLogistics.value[key]])
);
</script>
