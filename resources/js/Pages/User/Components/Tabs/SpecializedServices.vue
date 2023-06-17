<template>
  <div class="text-white text-5xl">Serviços especializados</div>
  <div class="grid grid-cols-4 gap-4 py-6 text-white">
    <div v-for="(group, letter) in groupedSpecializeds" :key="letter">
      <div class="text-2xl font-bold">{{ letter }}</div>
      <div v-for="(item, index) in group" :key="index">
        <a v-if="item.users_count > 0" :href="'/servico/especializado/' + item.id"
          >{{ item.acting }} ({{ item.users_count }})</a
        >
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";

const props = defineProps({
  user: Object,
});

const specializeds = ref([]);
const groupedSpecializeds = ref({});

onMounted(async () => {
  const response = await fetch("/api/specializeds");
  const data = await response.json();
  specializeds.value = data.specializeds;

  for (const item of specializeds.value) {
    const letter = item.acting.charAt(0).toUpperCase();
    if (!groupedSpecializeds.value[letter]) {
      groupedSpecializeds.value[letter] = [];
    }
    groupedSpecializeds.value[letter].push(item);
  }
});

const sortedKeys = Object.keys(groupedSpecializeds.value).sort();
groupedSpecializeds.value = Object.fromEntries(
  sortedKeys.map((key) => [key, groupedSpecializeds.value[key]])
);
</script>
