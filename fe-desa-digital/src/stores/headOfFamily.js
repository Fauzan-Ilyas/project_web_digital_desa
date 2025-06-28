import { defineStore } from 'pinia';
import { axiosInstance } from '@/plugins/axios';

export const useHeadOfFamilyStore = defineStore('head-Of-Family', {
    state: () => ({
        headOfFamily: [],
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
        async fetchHeadOfFamilies(params) {
            this.loading = true

            try {
                const response = await axiosInstance.get('head-of-family', { params })

                this.headOfFamilies= response.data.data;
            } catch (error) {
                this.error = handleError(error)
            }finally {
                this.loading = false
            }
        },

        async fetchHeadOfFamiliesPaginated(params) {
            this.loading = true

            try {
                const response = await axiosInstance.get('head-of-family/all/paginate', { params })

                this.headOfFamilies= response.data.data.data;
                this.meta = response.data.data.meta
            } catch (error) {
                this.error = handleError(error)
            }finally {
                this.loading = false
            }
        },

        async fetchHeadOfFamily(id) {
            this.loading = true

            try {
                const response = await axiosInstance.get(`/head-of-family/${id}`)

                return response.data.data
            } catch (error) {
                this.error = handleError(error)
            }finally {
                this.loading = false
            }
        },

        async createHeadOfFamily(payload) {
            this.loading = true

            try {
                const response = await axiosInstance.post("/head-of-family", payload)

                this.success = response.data.message

                router.push({ name: 'head-of-family' })
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },


        async fetchHeadOfFamily(id) {
            this.loading = true

            try {
                const response = await axiosInstance.delete(`/head-of-family/${id}`)

                this.success = response.data.message
            } catch (error) {
                this.error = handleError(error)
            }finally {
                this.loading = false
            }
        }
    }
})