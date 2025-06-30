import { defineStore } from "pinia";
import { axiosInstance } from "@/plugins/axios";
import { handleError } from "@/helpers/errorHelper";
import router from "@/router";

export const useEvenStore = defineStore("event", {
  state: () => ({
    events: {
      meta: {
        current_page: 1,
        last_page: 1,
        per_page: 10,
        total: 0,
      },
      data: [],
    },
    loading: false,
    error: null,
    success: null,
  }),

  actions: {
    async fetchevEntsPaginated(params) {
      this.loading = true;

      try {
        const response = await axiosInstance.get(
          "event/all/paginated",
          { params }
        );

        this.events = response.data.data.data;
        this.meta = response.data.data.meta;
      } catch (error) {
        this.error = handleError(error);
      } finally {
        this.loading = false;
      }
    },

    async fetchEvent(id) {
      this.loading = true;

      try {
        const response = await axiosInstance.get(`/event/${id}`);
        return response.data.data;
      } catch (error) {
        this.error = handleError(error);
      } finally {
        this.loading = false;
      }
    },

    async createEvent(payload) {
      this.loading = true;

      try {
        const response = await axiosInstance.post("/event", payload);
        this.success = response.data.message;

        router.push({ name: 'event' });
      } catch (error) {
        this.error = handleError(error);
      } finally {
        this.loading = false;
      }
    },


    async updateEvent(payload) {
      this.loading = true;

      try {
        const response = await axiosInstance.post(`/event/${payload.id}`, {
          ...payload,
          _method: 'PUT'
        });

        this.success = response.data.message;

        router.push({ name: 'manage-event', params: { id: payload.id } });
      } catch (error) {
        this.error = handleError(error);
      } finally {
        this.loading = false;
      }
    }
  }
});
