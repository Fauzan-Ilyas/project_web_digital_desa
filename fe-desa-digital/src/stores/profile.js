import { defineStore } from 'pinia';
import { axiosInstance } from '@/plugins/axios';
import { handleError } from '@/helpers/errorHelper';
import router from '@/router';

export const useProfileStore = defineStore('profile', {
    state: () => ({
        profile: null,
        meta: {
            current_page: 1,
            last_page: 1,
            per_page: 10,
            total: 0,
        },
        loading: false,
        error: null,
        success: null
    }),
    actions: {
        async fetchProfile() {
            this.loading = true
            try {
                const response = await axiosInstance.get('/profile')

                this.profile = response.data.data
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },

        async createProfile(payload) {
            this.loading = true
            try {
                const response = await axiosInstance.post('/profile', payload)
                
                this.success = response.data.message

                router.push({ name: 'profile' })
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        }
    }
})