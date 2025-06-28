import { defineStore } from 'pinia';
import { axiosInstance } from '@/plugins/axios';
import { handleError } from '@/helpers/errorHelper';
import router from '@/router';

export const useSocialAssistanceRecipientStore = defineStore('social-assistance-recipient', {
    state: () => ({
        socialAssistanceRecipients: [],
        meta: {
            current_page: 1,
            last_page: 1,
            per_page: 10,
            total: 0
        },
        loading: false,
        error: null,
        success: null
    }),
    actions: {
        async fetchSocialAssistanceRecipientsPaginated(page = 1) {
            this.loading = true

            try {
                const response = await axiosInstance.get(`social-assistance-recipient/all/paginated`, { params })

                this.socialAssistanceRecipients = response.data.data
                this.meta = response.data.data.meta
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },

        async fetchSocialAssistanceRecipient(id) {
            this.loading = true

            try {
                const response = await axiosInstance.get(`/social-assistance-recipient/${id}`)

                return response.data.data
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },

        async updateSocialAssistanceRecipient(playload) {
            this.loading = true

            try {
                const response = await axiosInstance.put(`/social-assistance-recipient/${payload.id}`, {
                    ...payload, 
                    _method: 'PUT'
                })

                this.success = response.data.message

                router.push({ name: 'manage-social-assistance-recipient', params: {id: payload.id} })
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        }
    }
});