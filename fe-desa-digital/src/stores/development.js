import { defineStore } from 'pinia'
import { axiosInstance } from '../plugins/axios'
import { handleError } from '@/helpers/errorHelper'
import router from '@/router'
import { update } from 'lodash';

export const useDevelopmentStore = defineStore('development', {
    state: () => ({
        developments: {},
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
        async fetchDevelopmentsPaginated(params) {
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

        async fetchDevelopment(id) {
            this.loading = true

            try {
                const response = await axiosInstance.get(`development/${id}`)

                return response.data.data
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },

        async createDevelopment(payload) {
            this.loading = true

            try {
                const response = await axiosInstance.post('development', payload)

                this.success = response.data.message

                router.push({ name: 'development' })
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },

        async updateDevelopment(payload) {
            this.loading = true

            try {
                const response = await axiosInstance.post(`development/${payload.id}`, {
                    ...payload,
                    _method: 'PUT'
                })

                this.success = response.data.message

                router.push({ name: 'manage-development', params: { id: payload.id } })
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        },

        async deleteDevelopment(id) {
            this.loading = true

            try {
                const response = await axiosInstance.delete(`development/${id}`)

                this.success = response.data.message
            } catch (error) {
                this.error = handleError(error)
            } finally {
                this.loading = false
            }
        }
    }
});
