import { defineStore } from 'pinia';
import { axiosInstance } from '@/plugins/axios';
import { handleError } from '@/helpers/errorHelper';
import router from '@/router';

export const useEventParticipantStore = defineStore('event-participant', {
    state: () => ({
        eventParticipants: [],
        meta: {
            current_page: 1,
            last_page: 1,
            per_page: 10,
            total: 1
        },
        loading: false,
        error: null,
        success: null
    }),
    actions: {
        async fetchEventParticipants(params) {
            this.loading = true

            try {
                const response = await axiosInstance.get('event-participant', { params })

                this.eventParticipants= response.data.data;
            } catch (error) {
                this.error = handleError(error)
            }finally {
                this.loading = false
            }
        },

    }
})