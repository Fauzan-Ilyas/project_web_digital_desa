<script setup>
import { useAuthStore } from "@/stores/auth";
import { useFamilyMemberStore } from "@/stores/familyMember";
import { storeToRefs } from "pinia";
import { onMounted } from "vue";

const familyMemberStore = useFamilyMemberStore();
const { familyMembers, loading } = storeToRefs(familyMemberStore);
const { fetchFamilyMembers } = familyMemberStore;

const authStore = useAuthStore();
const { user } = storeToRefs(authStore);

const calculateAge = (dateString) => {
  const today = new Date();
  const birthDate = new Date(dateString);
  let age = today.getFullYear() - birthDate.getFullYear();
  const m = today.getMonth() - birthDate.getMonth();
  if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
    age--;
  }
  return age;
};

onMounted(fetchFamilyMembers);
</script>

<template>
  <header class="flex items-center justify-between">
    <h1 class="font-semibold text-2xl leading-[30px]">Anggota Keluarga</h1>
    <RouterLink :to="{name:'create-family-member'}" class="shrink-0">
      <div
        class="px-6 py-4 rounded-2xl bg-desa-dark-green flex items-center gap-[10px]"
      >
        <img
          src="@/assets/images/icons/add-square-white.svg"
          alt="icon"
          class="size-6 shrink-0"
        />
        <p class="font-medium leading-5 text-white">Add New</p>
      </div>
    </RouterLink>
  </header>

  <div v-if="success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-2xl relative mb-4" 
        role="alert">
        <span class="block sm:inline">{{ success }}</span>
        
        <button type="button" @click="success = null" class="absolute top-1/2 -translate-y-1/2 right-4">
            <img src="@/assets/images/icons/close-circle-white.svg" class="flex size-6 shrink-0" alt="icon">
        </button>
    </div>

    <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl relative mb-4" 
        role="alert">
        <span class="block sm:inline">{{ error }}</span>

        <button type="button" @click="error = null" class="absolute top-1/2 -translate-y-1/2 right-4">
            <img src="@/assets/images/icons/close-circle-white.svg" class="flex size-6 shrink-0" alt="icon">
        </button>
    </div>

  <section
    id="Kepala-Keluarga"
    class="flex flex-col gap-6 p-6 bg-white rounded-3xl"
  >
    <h2 class="font-medium leading-5 text-desa-secondary">
      Kepala Keluarga (1)
    </h2>
    <div
      class="data rounded-2xl border border-desa-background p-6 items-center flex justify-between"
    >
      <div class="name flex items-center gap-3 min-w-[240px]">
        <div
          class="flex size-[64px] shrink-0 rounded-full overflow-hidden bg-desa-foreshadow"
        >
          <img
            :src="user?.head_of_family?.profile_picture"
            class="w-full h-full object-cover"
            alt="photo"
          />
        </div>
        <div class="flex flex-col gap-[6px]">
          <h3 class="font-semibold text-lg leading-[22.5px] line-clamp-1">
            {{ user?.name }}
          </h3>
          <div class="flex items-center gap-1">
            <img
              src="@/assets/images/icons/briefcase-secondary-green.svg"
              alt="icon"
              class="size-[18px] shrink-0"
            />
            <p class="font-medium leading-5 text-desa-secondary line-clamp-1">
              {{ user?.head_of_family?.occupation }}
            </p>
          </div>
        </div>
      </div>
      <div class="nik flex flex-col gap-[6px] min-w-[155px]">
        <div class="flex items-center gap-1">
          <img
            src="@/assets/images/icons/keyboard-secondary-green.svg"
            alt="icon"
            class="size-[18px] shrink-0"
          />
          <h3 class="font-medium leading-[17.5px] text-sm text-desa-secondary">
            NIK
          </h3>
        </div>
        <p class="font-semibold leading-5">{{ user?.head_of_family?.identity_number }}</p>
      </div>
      <div class="umur flex flex-col gap-[6px] min-w-[92px]">
        <div class="flex items-center gap-1">
          <img
            src="@/assets/images/icons/timer-secondary-green.svg"
            alt="icon"
            class="size-[18px] shrink-0"
          />
          <h3 class="font-medium leading-[17.5px] text-sm text-desa-secondary">
            Umur
          </h3>
        </div>
        <p class="font-semibold leading-5">{{ calculateAge(user?.head_of_family?.date_of_birth) }}</p>
      </div>
      <RouterLink :to="{ name: 'manage-family-member', params: { id: user?.head_of_family?.id } }" class="shrink-0">
        <div
          class="rounded-2xl px-6 py-[18px] bg-desa-black font-medium leading-5 text-white"
        >
          Manage
        </div>
      </RouterLink>
    </div>
  </section>
  <section id="Istri" class="flex flex-col gap-6 p-6 bg-white rounded-3xl"
    v-if="familyMembers.filter(member => member.relation === 'child').length > 0">
    <h2 class="font-medium leading-5 text-desa-secondary">Istri ({{ familyMembers.filter(member => member.relation === 'wife').length }})</h2>
    <div
      class="data rounded-2xl border border-desa-background p-6 flex items-center justify-between"
      v-for="wife in familyMembers.filter(member => member.relation === 'wife')"
    >
      <div class="name flex items-center gap-3 min-w-[240px]">
        <div
          class="flex size-[64px] shrink-0 rounded-full overflow-hidden bg-desa-foreshadow"
        >
          <img
            :src="wife.profile_picture"
            class="w-full h-full object-cover"
            alt="photo"
          />
        </div>
        <div class="flex flex-col gap-[6px]">
          <h3 class="font-semibold text-lg leading-[22.5px] line-clamp-1">
            {{ wife.user?.name }}
          </h3>
          <div class="flex items-center gap-1">
            <img
              src="@/assets/images/icons/briefcase-secondary-green.svg"
              alt="icon"
              class="size-[18px] shrink-0"
            />
            <p class="font-medium leading-5 text-desa-secondary line-clamp-1">
              {{ wife.occupation }}
            </p>
          </div>
        </div>
      </div>
      <div class="nik flex flex-col gap-[6px] min-w-[155px]">
        <div class="flex items-center gap-1">
          <img
            src="@/assets/images/icons/keyboard-secondary-green.svg"
            alt="icon"
            class="size-[18px] shrink-0"
          />
          <h3 class="font-medium leading-[17.5px] text-sm text-desa-secondary">
            NIK
          </h3>
        </div>
        <p class="font-semibold leading-5">{{ wife.identity_number }}</p>
      </div>
      <div class="umur flex flex-col gap-[6px] min-w-[92px]">
        <div class="flex items-center gap-1">
          <img
            src="@/assets/images/icons/timer-secondary-green.svg"
            alt="icon"
            class="size-[18px] shrink-0"
          />
          <h3 class="font-medium leading-[17.5px] text-sm text-desa-secondary">
            Umur
          </h3>
        </div>
        <p class="font-semibold leading-5">{{ calculateAge(wife.date_of_birth) }} Tahun</p>
      </div>
      <RouterLink :to="{ name: 'manage-family-member', params: { id: wife.id }}" class="shrink-0">
        <div
          class="rounded-2xl px-6 py-[18px] bg-desa-black font-medium leading-5 text-white"
        >
          Manage
        </div>
      </RouterLink>
    </div>
  </section>
  <section id="Anak" class="flex flex-col gap-6 p-6 bg-white rounded-3xl"
    v-if="familyMembers.filter(member => member.relation === 'child').length > 0">
    <h2 class="font-medium leading-5 text-desa-secondary">Anak ({{ familyMembers.filter(member => member.relation === 'child').length }})</h2>
     <div
      class="data rounded-2xl border border-desa-background p-6 flex items-center justify-between"
      v-for="child in familyMembers.filter(member => member.relation === 'child')"
    >
      <div class="name flex items-center gap-3 min-w-[240px]">
        <div
          class="flex size-[64px] shrink-0 rounded-full overflow-hidden bg-desa-foreshadow"
        >
          <img
            :src="child.profile_picture"
            class="w-full h-full object-cover"
            alt="photo"
          />
        </div>
        <div class="flex flex-col gap-[6px]">
          <h3 class="font-semibold text-lg leading-[22.5px] line-clamp-1">
            {{ child.user?.name }}
          </h3>
          <div class="flex items-center gap-1">
            <img
              src="@/assets/images/icons/briefcase-secondary-green.svg"
              alt="icon"
              class="size-[18px] shrink-0"
            />
            <p class="font-medium leading-5 text-desa-secondary line-clamp-1">
              {{ child.occupation }}
            </p>
          </div>
        </div>
      </div>
      <div class="nik flex flex-col gap-[6px] min-w-[155px]">
        <div class="flex items-center gap-1">
          <img
            src="@/assets/images/icons/keyboard-secondary-green.svg"
            alt="icon"
            class="size-[18px] shrink-0"
          />
          <h3 class="font-medium leading-[17.5px] text-sm text-desa-secondary">
            NIK
          </h3>
        </div>
        <p class="font-semibold leading-5">{{ child.identity_number }}</p>
      </div>
      <div class="umur flex flex-col gap-[6px] min-w-[92px]">
        <div class="flex items-center gap-1">
          <img
            src="@/assets/images/icons/timer-secondary-green.svg"
            alt="icon"
            class="size-[18px] shrink-0"
          />
          <h3 class="font-medium leading-[17.5px] text-sm text-desa-secondary">
            Umur
          </h3>
        </div>
        <p class="font-semibold leading-5">{{ calculateAge(child.date_of_birth) }} Tahun</p>
      </div>
      <RouterLink :to="{ name: 'manage-family-member', params: { id: child.id } }" class="shrink-0">
        <div
          class="rounded-2xl px-6 py-[18px] bg-desa-black font-medium leading-5 text-white"
        >
          Manage
        </div>
      </RouterLink>
    </div>
  </section>
</template>
