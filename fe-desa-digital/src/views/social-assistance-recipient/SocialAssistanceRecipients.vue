<script setup>
import { useSocialAssistanceRecipientStore } from "@/stores/socialAssistanceRecipient";
import { storeToRefs } from "pinia";
import { onMounted, ref, watch } from "vue";
import { debounce } from "lodash";
import Pagination from "@/components/ui/Pagination.vue";
import CardList from "@/components/social-assistance-recipient/CardList.vue";

// Init store
const socialAssistanceRecipientStore = useSocialAssistanceRecipientStore();
const {
  socialAssistanceRecipients,
  meta,
  loading,
  error,
  success
} = storeToRefs(socialAssistanceRecipientStore);
const {
  fetchSocialAssistanceRecipientsPaginated
} = socialAssistanceRecipientStore;

// Options & Filters
const serverOptions = ref({
  page: 1,
  row_per_page: 10,
});

const filters = ref({
  search: null,
});

// Fetching logic
const fetchData = async () => {
  await fetchSocialAssistanceRecipientsPaginated({
    ...serverOptions.value,
    ...filters.value,
  });
};

const debouncedFetchData = debounce(fetchData, 500);

// Lifecycle
onMounted(fetchData);

// Watchers
watch(serverOptions, fetchData, { deep: true });
watch(filters, () => debouncedFetchData(), { deep: true });
</script>

<template>
  <div id="Header" class="flex items-center justify-between">
    <h1 class="font-semibold text-2xl">Pengajuan Bantuan Sosial</h1>
  </div>

  <section id="List-pengajuan-Bansos" class="flex flex-col gap-[14px]">
    <!-- Search & Options -->
    <form id="Page-Search" class="flex items-center justify-between">
      <!-- Search Input -->
      <div class="flex flex-col gap-3 w-[370px] shrink-0">
        <label class="relative group peer w-full valid">
          <input
            v-model="filters.search"
            type="text"
            placeholder="Cari nama Pengajuan bantuan social"
            class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 pl-12 pr-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
          />
          <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
            <img
              src="@/assets/images/icons/user-search-secondary-green.svg"
              class="size-6 hidden group-has-[:placeholder-shown]:flex"
              alt="icon"
            />
            <img
              src="@/assets/images/icons/user-search-black.svg"
              class="size-6 flex group-has-[:placeholder-shown]:hidden"
              alt="icon"
            />
          </div>
        </label>
      </div>

      <!-- Select Row Per Page & Filter Button -->
      <div class="options flex items-center gap-4">
        <div class="flex items-center gap-[10px]">
          <span class="font-medium leading-5">Show</span>
          <div class="relative">
            <select
              v-model="serverOptions.row_per_page"
              class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 pr-[52px] gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
            >
              <option value="5">5 Entries</option>
              <option value="10">10 Entries</option>
              <option value="20">20 Entries</option>
              <option value="30">30 Entries</option>
              <option value="40">40 Entries</option>
              <option value="50">50 Entries</option>
            </select>
            <img
              src="@/assets/images/icons/arrow-down-black.svg"
              class="flex size-6 shrink-0 absolute transform -translate-y-1/2 top-1/2 right-6"
              alt="icon"
            />
          </div>
        </div>

        <button
          type="button"
          class="flex items-center gap-1 h-14 w-fit rounded-2xl border border-desa-background bg-white py-4 px-6"
        >
          <img
            src="@/assets/images/icons/filter-black.svg"
            class="flex size-6 shrink-0"
            alt="icon"
          />
          <span class="font-medium leading-5">Filter</span>
        </button>
      </div>
    </form>

    <!-- Card List -->
    <CardList
      v-for="socialAssistanceRecipient in socialAssistanceRecipients"
      :key="socialAssistanceRecipient.id"
      :item="socialAssistanceRecipient"
      v-if="!loading"
    />

    <!-- Pagination -->
    <Pagination :meta="meta" :server-options="serverOptions" />
  </section>
</template>
