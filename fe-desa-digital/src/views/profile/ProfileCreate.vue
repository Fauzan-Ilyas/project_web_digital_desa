<script setup>
import { useProfileStore } from "@/stores/profile";
import { storeToRefs } from "pinia";
import { ref } from "vue";

const profile = ref ({
    thumbnail: null,
    name: null,
    about: null,
    password: null,
    headman: null,
    people: null,
    agricultural_area: null,
    total_area: null,
    images: [],
});

const profileStore = useProfileStore();
const { loading, success } = storeToRefs(profileStore);
const { fetchProfile } = profileStore;

const handleSubmit = async () => {
    await createProfile({
  ...profile.value,
    images: (profile.value.images || [])
        .filter((img) => img && img.image)
        .map((img) => img.image)
    });

};

const addImage = () => {
    profile.value.images.push({
        image: null,
        image_url: null
    })
}

const removeImage = (index) => {
    profile.value.images.splice(index, 1)
}

const handleFileChange = (index, event) => {
    profile.value.images[index].image = event.target.files[0]
    profile.value.images[index].image_url = URL.createObjectURL(event.target.files[0])
}

const handleImageChange = (event) => {
    const file = event.target.files[0]
    profile.value.thumbnail = file
    profile.value.thumbnail_url = URL.createObjectURL(file)
};


</script>

<template>
        <div id="Header" class="flex items-center justify-between">
                        <div class="flex flex-col gap-2">
                            <div class="flex gap-1 items-center leading-5 text-desa-secondary">
                                <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize ">Profile Desa</p>
                                <span>/</span>
                                <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize ">Create Profile Desa</p>
                            </div>
                            <h1 class="font-semibold text-2xl">Create Profile Desa</h1>
                        </div>
                    </div>
                    <form @submit.prevent="handleSubmit" class="capitalize">
                        <div class="shrink-0 rounded-3xl p-6 bg-white flex flex-col gap-6 h-fit">
                            <section id="Photos" class="flex justify-between">
                                <h2 
                                    class="font-medium leading-5 text-desa-secondary flex h-[100px] items-center w-[calc(424/904*100%)]">
                                    Thumbnail Profile Desa</h2>
                                <div class="photo-input-container flex flex-col gap-6 flex-1">
                                    <div class="photo-form group/parent flex items-center justify-between">
                                        <div id="Photo-Preview"
                                            class="flex itce justify-center w-[120px] h-[100px] rounded-2xl overflow-hidden bg-desa-foreshadow">
                                            <img id="Photo" :src="profile.thumbnail_url" alt="image"
                                            class="Photo size-full object-cover" />
                                        </div>
                                        <div class="relative">
                                            <div class="action flex gap-3">
                                                <input id="File" type="file" name="file" 
                                                    class="photo-input absolute opacity-0 left-0 top-0 h-full" @change="handleImageChange"
                                                    ref="thumbnail" />
                                                <button id="Upload" type="button" 
                                                    class="relative flex items-center py-4 px-6 rounded-2xl bg-desa-black gap-[10px]"
                                                    @click="$refs.thumbnail.click()">
                                                    <img src="@/assets/images/icons/send-square-white.svg" alt="icon" 
                                                        class="size-6 shrink-0" />
                                                    <p class="font-medium leading-5 text-white">Upload</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button @click="addImage" type="button" 
                                        class="add-more-btn flex items-center w-full justify-center rounded-2xl py-4 px-6 gap-3 bg-desa-foreshadow">
                                        <p class="font-medium leading-5 text-desa-dark-green">Tambah Gambar Desa</p>
                                        <img src="@/assets/images/icons/add-square-dark-green.svg" class="flex size-6 shrink-0" alt="icon">
                                    </button>

                                    <div v-for="(image, index) in profile.images" :key="index" class="photo-form flex items-center">
                                        <div class="Photo-Preview flex itce justify-center w-[120px] h-[100px] rounded-2xl overflow-hidden">
                                            <img class="Photo size-full object-cover" :src="image.image_url" alt="image" />
                                        </div>
                                        <div class="relative">
                                            <input required type="file" @change="e => handleFileChange(index, e)"
                                                class="photo-input absolute opacity-0 left-0 top-0 size-0 -z-10" ref="image" />
                                            <div class="action flex gap-3">
                                                <button @click="$refs.image[index].click()" type="button"
                                                        class="Upload-btn relative flex items-center py-4 px-6 rounded-2xl bg-desa-black gap-[10px]">
                                                    <img src="@/assets/images/icons/send-square-white.svg" alt="icon" class="size-6 shrink-0" />
                                                    <p class="font-medium leading-5 text-white">Upload</p>
                                                </button>
                                                <button type="button"
                                                        class="delete size-14 rounded-2xl p-4 bg-desa-red items-center hidden justify-center"
                                                        @click="removeImage(this)">
                                                    <img src="@/assets/images/icons/trash-white.svg" class="flex size-6 shrink-0" alt="icon" />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Nama-Desa" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Nama Desa</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <label class="relative group peer w-full">
                                        <input type="text" v-model="profile.name" placeholder="Ketik nama desa" 
                                            class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                            <img src="@/assets/images/icons/building-4-secondary-green.svg" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                            <img src="@/assets/images/icons/building-4-black.svg" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Kepala-Desa" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Nama Kepala Desa</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <label class="relative group peer w-full">
                                        <input type="text" v-model="profile.headman" placeholder="Pilih Kepala Desa" 
                                            class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                            <img src="@/assets/images/icons/user-square-secondary-green.svg" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                            <img src="@/assets/images/icons/user-square-black.svg" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Luas-Pertanian" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Luas Pertanian Desa</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <label class="relative group peer w-full">
                                        <input type="number" v-model="profile.agricultural_area" 
                                            placeholder="Masukan total luas pertanian" 
                                            class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 pr-[98px] gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                            <img src="@/assets/images/icons/tree-secondary-green.svg" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                            <img src="@/assets/images/icons/tree-black.svg" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                                        </div>
                                        <div class="absolute transform -translate-y-1/2 top-1/2 right-4 flex shrink-0 gap-6">
                                            <div class="w-px h-6 border border-desa-background"></div>
                                            <span class="font-medium leading-5 text-desa-black group-has-[:placeholder-shown]:text-desa-secondary normal-case">m<sup>2</sup></span>
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Luas-Area" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Luas Area Desa</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <label class="relative group peer w-full">
                                        <input type="number" v-model="profile.total_area" placeholder="Masukan total luas area" 
                                            class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 pr-[98px] gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                            <img src="@/assets/images/icons/grid-5-secondary-green.svg" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                            <img src="@/assets/images/icons/grid-5-black.svg" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                                        </div>
                                        <div class="absolute transform -translate-y-1/2 top-1/2 right-4 flex shrink-0 gap-6">
                                            <div class="w-px h-6 border border-desa-background"></div>
                                            <span class="font-medium leading-5 text-desa-black group-has-[:placeholder-shown]:text-desa-secondary normal-case">m<sup>2</sup></span>
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Jumlah Penduduk" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Jumlah Penduduk Desa</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <label class="relative group peer w-full">
                                        <input type="number" v-model="profile.people" placeholder="Masukan total penduduk desa" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                                        <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                                            <img src="@/assets/images/icons/profile-2user-secondary-green.svg" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                                            <img src="@/assets/images/icons/profile-2user-black.svg" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                                        </div>
                                    </label>
                                </div>
                            </section>
                            <hr class="border-desa-background" />
                            <section id="Deskripsi" class="flex items-center justify-between">
                                <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Deskripsi Tentang Desa</p>
                                <div class="flex flex-col gap-3 flex-1 shrink-0">
                                    <textarea v-model="profile.about" placeholder="Jelaskan lebih detail tentang desa terkait" rows="6" class="appearance-none outline-none w-full rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-4 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"></textarea>
                                </div>
                            </section>
                            <hr class="border-desa-background w-[calc(100%+48px)] -mx-6" />
                            <section id="Buttons" class="flex items-center justify-end gap-4">
                                <RouterLink :to="{ name: 'profile' }">
                                    <div class="py-[18px] rounded-2xl bg-desa-red w-[180px] text-center flex justify-center font-medium text-white">Batal, Tidak jadi</div>
                                </RouterLink>
                                <button disabled id="submitButton" type="submit" class="py-[18px] rounded-2xl disabled:bg-desa-grey w-[180px] text-center flex justify-center font-medium text-white bg-desa-dark-green transition-all duration-300">Create Now</button>
                            </section>
                        </div>
                    </form>
</template>