import { defineStore } from 'pinia'
import { axiosInstance } from '@/plugins/axios'
import { handleError } from '@/helpers/errorHelper'
import router from '@/router'

export const useDevelopmentStore = defineStore('development', {
    state: () => ({
        developmentData: {},
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
        async fetchDevelopmentPaginated(params) {
            this.loading = true

            try {
                const response = await axiosInstance.get(`development/all/paginated`, { params })

                this.developments = response.data.data.data
                this.meta = response.data.data.meta
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },
    }
});