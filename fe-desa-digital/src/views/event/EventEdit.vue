<script setup>
import { formatRupiah, parseRupiah } from "@/helpers/format";
import { useEventStore } from "@/stores/event";
import { storeToRefs } from "pinia";
import { onMounted, ref, watch } from "vue";
import { useRoute } from "vue-router";

import IconEditSecondaryGreen from '@/assets/images/icons/edit-secondary-green.svg'
import IconEditBlack from '@/assets/images/icons/edit-black.svg'
import IconProfileCircleSecondaryGreen from '@/assets/images/icons/profile-circle-secondary-green.svg'
import IconProfileCircleBlack from '@/assets/images/icons/profile-circle-black.svg'
import IconCalendarSecondaryGreen from '@/assets/images/icons/calendar-2-secondary-green.svg'
import IconCalendarBlack from '@/assets/images/icons/calendar-2-black.svg'
import IconDollarSquareSecondaryGreen from '@/assets/images/icons/dollar-square-secondary-green.svg'
import IconDollarSquareBlack from '@/assets/images/icons/dollar-square-black.svg'
import Input from '@/components/ui/input.vue'


const route = useRoute()

    const event = ref({
    id: null,
    thumbnail: null,
    thumbnail_url: null,
    name: null,
    description: null,
    price: null,
    date: null,
    time: null,
    is_active: null,
    })

    const eventStore = useEventStore();
    const { loading, error, success } = storeToRefs(eventStore)
    const { fetchEvent, updateEvent } = eventStore

    const fetchData = async () => {
    const response = await fetchEvent(route.params.id)

    event.value = response;
    event.value.thumbnail_url = response.thumbnail
    event.value.thumbnail = null
    };

    const handleSubmit = async () => {
        await updateEvent({
            ...event.value,
            price: parseRupiah(event.value.price)
        })
    }

    const handleImageChange = (event) => {
    const file = event.target.files[0];
    event.value.thumbnail = file;
    event.value.thumbnail_url = URL.createObjectURL(file)
    }

    watch(
        () => event.value.price,
        (newPrice) => {
            if (typeof newPrice === 'number' || !newPrice.startsWith('Rp')) {
            event.value.price = formatRupiah(newPrice);
            }
        }
    );



onMounted(fetchData);
</script>

    <template>
    <div id="Header" class="flex items-center justify-between">
        <div class="flex flex-col gap-2">
        <div class="flex gap-1 items-center leading-5 text-desa-secondary">
            <p
            class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize"
            >
            Event
            </p>
            <span>/</span>
            <p
            class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize"
            >
            Edit Event
            </p>
        </div>
        <h1 class="font-semibold text-2xl">Edit Pembangunan Desa</h1>
        </div>
    </div>
    <form @submit.prevent="handleSubmit" id="myForm" class="capitalize">
        <div class="shrink-0 rounded-3xl p-6 bg-white flex flex-col gap-6 h-fit">
        <section id="Thumbnail" class="flex items-center justify-between">
            <h2
            class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]"
            >
            Thumbnail Pembangunan Terkait
            </h2>
            <div class="flex-1 flex items-center justify-between">
            <div
                id="Photo-Priview"
                class="flex items-center justify-center w-[120px] h-[100px] rounded-2xl overflow-hidden bg-desa-foreshadow"
            >
                <img
                id="Photo"
                :src="event.thumbnail_url"
                alt="img"
                class="size-full object-cover"
                />
            </div>
            <div class="relative">
                <input
                id="File"
                type="file"
                name="file"
                class="absolute opacity-0 left-0 w-full top-0 h-full"
                @change="$refs.thumbnail.click()"
                />
                <button
                id="Upload"
                type="button"
                class="relative flex items-center py-4 px-6 rounded-2xl bg-desa-black gap-[10px]"
                @click="$refs.thumbnail.click()"
                >
                <img
                    src="@/assets/images/icons/send-square-white.svg"
                    alt="icon"
                    class="size-6 shrink-0"
                />
                <p class="font-medium leading-5 text-white">Upload</p>
                </button>
            </div>
            </div>
        </section>
        <hr class="border-desa-background" />
        <section id="Nama-Projek" class="flex items-center justify-between">
            <p
            class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]"
            >
            Nama Event
            </p>
            <div class="flex flex-col gap-3 flex-1 shrink-0">
            <input
                v-model="event.name"
                type="text"
                placeholder="Ketik Nama Kamu"
                :error-message="error?.name"
                :icon="IconEditSecondaryGreen"
                :filled-icon="IconEditBlack"
            />
            </div>
        </section>
        <hr class="border-desa-background" />
        <section id="Penanggung-Jawab" class="flex items-center justify-between">
            <p
            class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]"
            >
            Harga
            </p>
            <div class="flex flex-col gap-3 flex-1 shrink-0">
            <input
                v-model="event.price"
                type="text"
                placeholder="Ketik Biaya Event"
                :error-message="error?.price"
                :icon="IconDollarSquareSecondaryGreen"
                :filled-icon="IconCalendarBlack"
            />
            </div>
        </section>
        <hr class="border-desa-background" />
        <section id="Status" class="flex items-center justify-between">
            <p
            class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]"
            >
            Status Pembangunan
            </p>
            <div class="flex flex-1 gap-6 shrink-0">
            <label
                class="group flex w-full items-center h-14 rounded-2xl p-4 ring-[1.5px] ring-desa-background gap-2 has-[:checked]:ring-none has-[:checked]:bg-desa-foreshadow transition-setup"
            >
                <input
                v-model="event.is_active"
                value="1"
                type="radio"
                name="status"
                id=""
                class="flex size-[18px] shrink-0 accent-desa-secondary checked:accent-desa-dark-green transition-setup"
                />
                <span
                class="font-medium leading-5 text-desa-secondary w-full group-has-[:checked]:text-desa-dark-green transition-setup"
                >
                Open
                </span>
                <div class="flex size-6 shrink-0">
                <img
                    src="@/assets/images/icons/tick-circle-secondary-green.svg"
                    class="size-6 flex group-has-[:checked]:hidden"
                    alt="icon"
                />
                <img
                    src="@/assets/images/icons/tick-circle-dark-green.svg"
                    class="size-6 hidden group-has-[:checked]:flex"
                    alt="icon"
                />
                </div>
            </label>
            <label
                class="group flex w-full items-center h-14 rounded-2xl p-4 ring-[1.5px] ring-desa-background gap-2 has-[:checked]:ring-none has-[:checked]:bg-desa-foreshadow transition-setup"
            >
                <input
                v-model="event.is_active"
                value="0"
                type="radio"
                name="status"
                id=""
                class="flex size-[18px] shrink-0 accent-desa-secondary checked:accent-desa-dark-green transition-setup"
                />
                <span
                class="font-medium leading-5 text-desa-secondary w-full group-has-[:checked]:text-desa-dark-green transition-setup"
                >
                Closed
                </span>
                <div class="flex size-6 shrink-0">
                <img
                    src="@/assets/images/icons/close-circle-secondary-green.svg"
                    class="size-6 flex group-has-[:checked]:hidden"
                    alt="icon"
                />
                <img
                    src="@/assets/images/icons/close-circle-secondary-green.svg"
                    class="size-6 hidden group-has-[:checked]:flex"
                    alt="icon"
                />
                </div>
            </label>
            </div>
        </section>
        <hr class="border-desa-background" />
        <section
            id="Tanggal-Pembangunan"
            class="flex items-center justify-between"
        >
            <p
            class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]"
            >
            Tanggal Event
            </p>
            <div class="flex items-center gap-6 flex-1 shrink-0">
            <label class="relative group peer w-full">
                <input
                v-model="event.date"
                type="date"
                placeholder="pilih Tanggal Awal"
                :error-message="error?.date"
                :icon="IconCalendarSecondaryGreen"
                :filled-icon="'IconCalendarBlack'"
                />
            </label>
            </div>
        </section>
        <hr class="border-desa-background" />
            <section
            id="Tanggal-Pembangunan"
            class="flex items-center justify-between"
        >
            <p
            class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]"
            >
            Waktu Event
            </p>
            <div class="flex items-center gap-6 flex-1 shrink-0">
            <label class="relative group peer w-full">
                <input
                v-model="event.time"
                type="time"
                placeholder="Pilih Waktu"
                :error-message="error?.time"
                :icon="'IconCalendarSecondaryGreen'"
                :filled-icon="'IconCalendarBlack'"
                />
            </label>
            </div>
        </section>
        <hr class="border-desa-background" />
        <section id="Deskripsi" class="flex items-center justify-between">
            <p
            class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]"
            >
            Deskripsi Pembangunan
            </p>
            <div class="flex flex-col gap-3 flex-1 shrink-0">
            <textarea
                v-model="event.description"
                name=""
                id=""
                placeholder="Jelaskan lebih detail tentang pembangunan"
                rows="6"
                class="appearance-none outline-none w-full rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-4 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
            >
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, cupiditate.
                                        </textarea
            >
            </div>
        </section>
        <hr class="border-desa-background w-[calc(100%+48px)] -mx-6" />
        <section id="Buttons" class="flex items-center justify-end gap-4">
            <RouterLink :to="{ name: 'manage_event', params: { id: event.id } }">
            <div
                class="py-[18px] rounded-2xl bg-desa-red w-[180px] text-center flex justify-center font-medium text-white"
            >
                Batal, Tidak jadi
            </div>
            </RouterLink>
            <button
            id="submitButton"
            type="submit"
            class="py-[18px] rounded-2xl disabled:bg-desa-grey w-[180px] text-center flex justify-center font-medium text-white bg-desa-dark-green transition-all duration-300"
            >
            Save Changes
            </button>
        </section>
        </div>
    </form>
    </template>