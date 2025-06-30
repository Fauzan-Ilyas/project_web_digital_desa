import { defineStore } from "pinia";
import { axiosInstance } from "../plugins/axios";
import { handleError } from "@/helpers/errorHelper";
import router from "@/router";

export const useSocialAssistanceStore = defineStore("social-assistance",{
    state: () => ({
       socialAssistances: [],
       meta: {
        current_page: 1,
        last_page: 1,
        per_page: 10,
        total: 0,
       },
       loading: false,
       error: null,
       success: null,
    }),
    actions : {
        async fetchSosialAssistancesPaginated(params) {
            this.loading = true

            try {
                const response = await axiosInstance.get(`social-assistance/all/paginated`,{ params })

                this.socialAssistances = response.data.data.data
                this.meta = response.data.data.meta
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },

        async fetchSocialAssistance(id) {
            this.loading = true

            try {
                const response = await axiosInstance.get(`/social-assistance/${id}`)

                return response.data.data
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },

        async createSocialAssistance(payload) {
            this.loading = true

            try {
                const response = await axiosInstance.post("/social-assistance", payload)

                this.success = response.data.message

                router.push({ name: 'social-assistance' })
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },

        async UpdateSocialAssistance(payload){
            this.loading = true

            try {
                const response = await axiosInstance.post(`/social-assistance/${payload.id}`, {
                    ...payload,
                    _method: 'PUT'
                })

               this.succes = response.data.message

               router.push({ name: 'manage-social-assistance', params: { id: payload.id } })
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },

        async deleteSocialAssistance(id) {
            this.loading = true

            try {
                const response = await axiosInstance.delete(`/social-assistance/${id}`)

               this.succes = response.data.message
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        }

        
    }
})