<script setup>
import { useFamilyMemberStore } from '@/stores/familyMember';
import { storeToRefs } from 'pinia';
import { ref, onMounted } from 'vue';
import Input from '@/components/input.vue';

import IconProfileSecondaryGreen from '@/assets/images/icons/user-secondary-green.svg';
import IconProfileBlack from '@/assets/images/icons/user-black.svg';
import IconKeyboardSecondaryGreen from '@/assets/images/icons/keyboard-secondary-green.svg';
import IconKeyboardBlack from '@/assets/images/icons/keyboard-black.svg';
import IconCallSecondaryGreen from '@/assets/images/icons/call-secondary-green.svg';
import IconCallBlack from '@/assets/images/icons/call-black.svg';
import IconBriefCaseSecondaryGreen from '@/assets/images/icons/briefcase-secondary-green.svg';
import IconBriefCaseBlack from '@/assets/images/icons/briefcase-black.svg';
import IconCalendarSecondaryGreen from '@/assets/images/icons/calendar-2-secondary-green.svg';
import IconCalendarBlack from '@/assets/images/icons/calendar-2-black.svg';
import IconKeySecondaryGreen from '@/assets/images/icons/key-secondary-green.svg';
import IconKeyBlack from '@/assets/images/icons/key-black.svg';

const familyMemberStore = useFamilyMemberStore();
const { loading, error } = storeToRefs(familyMemberStore);
const { createFamilyMember } = familyMemberStore;

const familyMember = ref({
    name: null,
    email: null,
    password: null,
    profile_picture: null,
    profile_picture_url: null,
    identity_number: null,
    gender: null,
    date_of_birth: null,
    age: null,
    phone_number: null,
    occupation: null,
    marital_status: null,
    relation: null,
});

const handleSubmit = async () => {
    await createFamilyMember(familyMember.value);
};

const handleImageChange = (event) => {
  const file = event.target.files[0];
  familyMember.value.profile_picture = file;
  familyMember.value.profile_picture_url = URL.createObjectURL(file);
};

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

watch(() => familyMember.value.date_of_birth, (newDate) => {
    familyMember.value.age = calculateAge(newDate);
});

</script>

<template>
            <div id="Header" class="flex items-center justify-between">
                <div class="flex flex-col gap-2">
                    <div class="flex gap-1 items-center leading-5 text-desa-secondary">
                        <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize ">Kepala Rumah</p>
                            <span>/</span>
                                <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize ">Tambah Anggota Keluarga</p>
                    </div>
                        <h1 class="font-semibold text-2xl">Tambah Anggota Keluarga Baru</h1>
                </div>
            </div>
                    <form @submit.prevent="handleSubmit" id="myForm" class="capitalize">
                        <div class="shrink-0 rounded-3xl p-6 bg-white flex flex-col gap-6 h-fit">
                            <section id="Photo-Profile" class="flex items-center justify-between">
                                <h2 class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Profile Anggota Keluarga</h2>
                                <div class="flex-1 flex items-center justify-between">
                                    <div id="Photo-Preview" class="flex itce justify-center size-[100px] rounded-full overflow-hidden bg-desa-foreshadow">
                                        <img id="Photo" :src="familyMember.profile_picture_url" alt="image" class="size-full object-cover" />
                                    </div>
                                    <div class="relative">
                                        <input required id="File" type="file" name="file"
                                            class="absolute opacity-0 left-0 w-full top-0 h-full" @change="handleImageChange"
                                            ref="profile_picture"/>
                                        <button id="Upload" type="button" 
                                            class="relative flex items-center py-4 px-6 rounded-2xl bg-desa-black gap-[10px]"
                                            @click="$refs.profile_picture.click()">
                                            <img src="@/assets/images/icons/send-square-white.svg" alt="icon" class="size-6 shrink-0" />
                                            <p class="font-medium leading-5 text-white">Upload</p>
                                        </button>
                                    </div>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Nama-Kepala-Rumah" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Nama Anggota Keluarga</p>

                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <Input v-model="familyMember.name" type="text" placeholder="Ketik Nama Kamu"
                                    :error-message="error?.name":icon="'IconProfileSecondaryGreen'" :filled-icon="'IconProfileBlack'" />
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="NIK" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Nomor Induk Kependudukan</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <Input v-model="familyMember.identity_number" type="text" placeholder="Ketik NIK Kamu"
                                    :error-message="error?.identity_number":icon="'IconKeyboardSecondaryGreen'" :filled-icon="'IconKeyboardBlack'" />
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Phone" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Nomor Handphone</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <Input v-model="familyMember.phone_number" type="text" placeholder="Ketik Nomor Hendphone Kamu"
                                    :error-message="error?.phone_number":icon="'IconCallSecondaryGreen'" :filled-icon="'IconCallBlack'" />
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Pekerjaan" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Pekerjaan</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <Input v-model="familyMember.occupation" type="text" placeholder="Ketik Pekerjaan Kamu"
                                    :error-message="error?.occupation":icon="'IconBriefCaseSecondaryGreen'" :filled-icon="'IconBriefCaseBlack'" />
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Tanggal-Lahir" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Tanggal Lahir</p>
                                <div class="flex items-center gap-6 flex-1 shrink-0">
                                    <label class="relative group peer w-full valid">
                                        <Input v-model="familyMember.date_of_birth" type="date" placeholder="Pilih Tanggal Lahir Kamu"
                                            :error-message="error?.date_of_birth":icon="'IconCalendarSecondaryGreen'" :filled-icon="'IconCalendarBlack'" />
                                    </label>
                                    <div class="w-[180px] flex shrink-0 h-[52px] rounded-2xl bg-desa-foreshadow p-4 font-medium leading-5 text-desa-dark-green justify-center">
                                        <p>Umur: <span id="Age">{{ familyMember.age }}</span> tahun</p>
                                    </div>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Jenis-Kelamin" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Jenis Kelamin</p>
                                <div class="flex flex-1 gap-6 shrink-0">
                                    <label class="group flex w-full items-center h-14 rounded-2xl p-4 ring-[1.5px] ring-desa-background gap-2 has-[:checked]:ring-desa-dark-green transition-setup">
                                        <input type="radio" name="gender" id=""
                                        class="flex size-[18px] shrink-0 accent-desa-secondary checked:accent-desa-dark-green transition-setup"
                                        v-model="familyMember.gender" value="male">
                                        <span
                                         class="font-medium leading-5 text-desa-secondary w-full group-has-[:checked]:text-desa-dark-green transition-setup">
                                            Pria
                                        </span>
                                        <div class="flex size-6 shrink-0">
                                            <img src="@/assets/images/icons/man-secondary-green.svg" class="size-6 flex group-has-[:checked]:hidden" alt="icon">
                                            <img src="@/assets/images/icons/man-dark-green.svg" class="size-6 hidden group-has-[:checked]:flex" alt="icon">
                                        </div>
                                    </label>
                                    <label class="group flex w-full items-center h-14 rounded-2xl p-4 ring-[1.5px] ring-desa-background gap-2 has-[:checked]:ring-desa-dark-green transition-setup">
                                        <input type="radio" name="gender" id=""
                                        class="flex size-[18px] shrink-0 accent-desa-secondary checked:accent-desa-dark-green transition-setup"
                                        v-model="familyMember.gender" value="female">
                                        <span
                                         class="font-medium leading-5 text-desa-secondary w-full group-has-[:checked]:text-desa-dark-green transition-setup">
                                            Wanita
                                        </span>
                                        <div class="flex size-6 shrink-0">
                                            <img src="@/assets/images/icons/woman-secondary-green.svg" class="size-6 flex group-has-[:checked]:hidden" alt="icon">
                                            <img src="@/assets/images/icons/woman-dark-green.svg" class="size-6 hidden group-has-[:checked]:flex" alt="icon">
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Status" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Status</p>
                                <div class="flex flex-1 gap-6 shrink-0">
                                    <label class="group flex w-full items-center h-14 rounded-2xl p-4 ring-[1.5px] ring-desa-background gap-2 has-[:checked]:ring-desa-dark-green transition-setup">
                                        <input type="radio" name="status" id=""
                                         class="flex size-[18px] shrink-0 accent-desa-secondary checked:accent-desa-dark-green transition-setup"
                                         v-model="familyMember.marital_status" value="single">
                                        <span class="font-medium leading-5 text-desa-secondary w-full group-has-[:checked]:text-desa-dark-green transition-setup">
                                            Belum Menikah
                                        </span>
                                        <div class="flex size-6 shrink-0">
                                            <img src="@/assets/images/icons/profile-secondary-green.svg" class="size-6 flex group-has-[:checked]:hidden" alt="icon">
                                            <img src="@/assets/images/icons/profile-dark-green.svg" class="size-6 hidden group-has-[:checked]:flex" alt="icon">
                                        </div>
                                    </label>
                                    <label class="group flex w-full items-center h-14 rounded-2xl p-4 ring-[1.5px] ring-desa-background gap-2 has-[:checked]:ring-desa-dark-green transition-setup">
                                        <input type="radio" name="status" id=""
                                         class="flex size-[18px] shrink-0 accent-desa-secondary checked:accent-desa-dark-green transition-setup"
                                         v-model="familyMember.marital_status" value="married">
                                        <span class="font-medium leading-5 text-desa-secondary w-full group-has-[:checked]:text-desa-dark-green transition-setup">
                                            Sudah Menikah
                                        </span>
                                        <div class="flex size-6 shrink-0">
                                            <img src="@/assets/images/icons/profile-2user-secondary-green.svg" class="size-6 flex group-has-[:checked]:hidden" alt="icon">
                                            <img src="@/assets/images/icons/profile-2user-dark-green.svg" class="size-6 hidden group-has-[:checked]:flex" alt="icon">
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background w-[calc(100%+48px)] -mx-6" />
                            <section id="Kategori-Keluarga" class="flex items-center">
                                <h2 class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Kategori Keluarga</h2>
                                <div class="flex-1 grid grid-cols-3 gap-6">
                                    <label class="relative flex items-center gap-2 rounded-2xl border border-desa-background p-4 hover:border-transparent hover:bg-desa-foreshadow has-[:checked]:bg-desa-foreshadow hover:ring-[1.5px] hover:ring-desa-dark-green has-[:checked]:ring-[1.5px] has-[:checked]:ring-desa-dark-green transition-all duration-300">
                                        <input v-model="familyMember.relation" value="wife" required type="radio" name="kategori-keluarga" id="Istri" class="peer flex size-[18px] shrink-0 accent-desa-dark-green" />
                                        <p class="w-full font-medium text-desa-secondary leading-5 peer-checked:text-desa-dark-green">Istri</p>
                                    </label>
                                    <label class="relative flex items-center gap-2 rounded-2xl border border-desa-background p-4 hover:border-transparent hover:bg-desa-foreshadow has-[:checked]:bg-desa-foreshadow hover:ring-[1.5px] hover:ring-desa-dark-green has-[:checked]:ring-[1.5px] has-[:checked]:ring-desa-dark-green transition-all duration-300">
                                        <input v-model="familyMember.relation" value="child" required type="radio" name="kategori-keluarga" id="Anak" class="peer flex size-[18px] shrink-0 accent-desa-dark-green" />
                                        <p class="w-full font-medium text-desa-secondary leading-5 peer-checked:text-desa-dark-green">Anak</p>
                                    </label>
                                    <label class="relative flex items-center gap-2 rounded-2xl border border-desa-background p-4 hover:border-transparent hover:bg-desa-foreshadow has-[:checked]:bg-desa-foreshadow hover:ring-[1.5px] hover:ring-desa-dark-green has-[:checked]:ring-[1.5px] has-[:checked]:ring-desa-dark-green transition-all duration-300">
                                        <input v-model="familyMember.relation" value="husband" required type="radio" name="kategori-keluarga" id="Suami" class="peer flex size-[18px] shrink-0 accent-desa-dark-green" />
                                        <p class="w-full font-medium text-desa-secondary leading-5 peer-checked:text-desa-dark-green">Suami</p>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background w-[calc(100%+48px)] -mx-6" />
                            <p class="font-medium leading-5">Akun Dashboard</p>
                            <section id="Email" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Email Address</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <Input v-model="familyMember.email" type="email" placeholder="Ketik Email Kamu"
                                        :error-message="error?.email" :icon="IconProfileSecondaryGreen"
                                        :filled-icon="IconProfileBlack"/>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Passwords" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Passwords</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <Input v-model="familyMember.password" type="password" placeholder="Ketik Password Kamu"
                                        :error-message="error?.password" :icon="IconKeySecondaryGreen"
                                        :filled-icon="IconKeyBlack"/>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Buttons" class="flex items-center justify-end gap-4">
                                <RouterLink :to="{ name: 'head-of-family' }">
                                    <div 
                                    class="py-[18px] rounded-2xl bg-desa-red w-[180px] text-center flex justify-center font-medium text-white">Batal, Tidak jadi</div>
                                </RouterLink>

                                <button :disabled="loading" id="submitButton" type="submit" 
                                    class="py-[18px] rounded-2xl disabled:bg-desa-grey w-[180px] text-center font-medium text-white bg-desa-dark-green transition-all duration-300">
                                    <span v-if="!loading">Create Now</span>
                                    <span v-else>Loading.....</span>
                                </button>
                            </section>
                        </div>
                    </form>
</template>