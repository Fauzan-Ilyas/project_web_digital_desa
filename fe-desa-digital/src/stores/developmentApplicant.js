import { defineStore } from 'pinia'
import { axiosInstance } from '../plugins/axios'
import { handleError } from '@/helpers/errorHelper'
import router from '@/router'
import { update } from 'lodash';

export const useDevelopmentApplicantStore = defineStore('development-applicant', {
    state: () => ({
        developmentApplicants: {},
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
         async createDevelopmentApplicant(payload) {
            this.loading = true

            try {
                const response = await axiosInstance.post('development-applicant', payload)

                this.success = response.data.message

                router.push({ name: 'development' })
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },
    }
});