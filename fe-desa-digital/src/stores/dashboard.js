import { handleError } from "@/helpers/errorHelper";
import { axiosInstance } from "@/plugins/axios";
import { defineStore } from "pinia";

export const useDashboardStore = defineStore('dashboard', {
    state: () => ({
        dashboardData: {},
        loading: false,
        error: null,
        success: null,
    }),
    // actions: {
    //     async fetchDashboardData() {
    //         this.loading = true

    //         try {
    //             const response = await axiosInstance.get('/dashboard/get-dashboard-data')

    //             this.dashboardData = response.data.data
    //         } catch (error) {
    //             this.error = handleError(error)
    //         } finally {
    //             this.loading = false
    //         }
    //     },
    // }/
// });


// // stores/dashboard.js
// import { defineStore } from 'pinia'

// // export const useDashboardStore = defineStore('dashboard', {
// //   state: () => ({
// //     dashboardData: null,
// //     loading: false
// //   }),

  actions: {
    async fetchDashboardData() {
      this.loading = true
      
      // Simulate API call delay
      await new Promise(resolve => setTimeout(resolve, 1000))
      
      // Dummy data matching your template structure
      this.dashboardData = {
        // Statistics cards data
        residents: '243.000',
        developments: '87',
        head_of_families: '62.450',
        events: '24',
        social_assistances: '156',
        
        // Social assistance (Bantuan Sosial) list
        social_assistance_list: [
          {
            id: 1,
            type: 'money',
            amount: 'Rp362.500.000',
            giver: 'Shayna Sakura',
            status: 'pending', // pending, accepted, rejected
            icon: 'money-dark-green.svg'
          },
          {
            id: 2,
            type: 'goods',
            amount: 'Beras 10kg',
            giver: 'Angga Hikari',
            status: 'accepted',
            icon: 'bag-2-dark-green.svg'
          },
          {
            id: 3,
            type: 'money',
            amount: 'Rp52.500.000',
            giver: 'Obito Uciha',
            status: 'rejected',
            icon: 'money-dark-green.svg'
          },
          {
            id: 4,
            type: 'money',
            amount: 'Rp52.500.000',
            giver: 'Masayoshi',
            status: 'accepted',
            icon: 'money-dark-green.svg'
          }
        ],
        
        // Events data
        events_list: [
          {
            id: 1,
            title: 'Belajar Coding Bersama',
            time: '11:30 WIB',
            date: '2024-12-31',
            image: 'event-image-1.png'
          },
          {
            id: 2,
            title: 'Gotong Royong Desa',
            time: '08:00 WIB',
            date: '2025-01-05',
            image: 'event-image-2.png'
          }
        ],
        
        // Applicants data
        applicants: {
          total: '1.200',
          list: [
            {
              id: 1,
              name: 'Masayoshi',
              application: 'Melamar pembangunan Jalanan Utama Desa',
              status: 'pending',
              avatar: 'kk-photo-1.png',
              thumbnail: 'kd-applicant-1.png'
            },
            {
              id: 2,
              name: 'Surti Jasmine',
              application: 'Melamar pembangunan Balai Desa',
              status: 'accepted',
              avatar: 'kk-photo-2.png',
              thumbnail: 'kd-applicant-2.png'
            },
            {
              id: 3,
              name: 'Mirna Wonongso',
              application: 'Melamar pembangunan Puskemas Desa',
              status: 'rejected',
              avatar: 'kk-photo-3.png',
              thumbnail: 'kd-applicant-3.png'
            }
          ]
        },
        
        // Population statistics (for the doughnut chart)
        population_stats: {
          total: 243000,
          demographics: {
            men: {
              count: 114210,
              age_range: '32-36 tahun',
              color: '#34613A'
            },
            women: {
              count: 97200,
              age_range: '26-31 tahun',
              color: '#8EBD55'
            },
            children: {
              count: 24300,
              age_range: '6-12 tahun',
              color: '#FA7139'
            },
            toddlers: {
              count: 7290,
              age_range: '0-5 tahun',
              color: '#FBAD48'
            }
          }
        },
        
        // Calendar data
        calendar: {
          current_month: 'December 2024',
          selected_date: 31,
          dates: [
            { date: 28, day: 'Sen', active: false },
            { date: 29, day: 'Sel', active: false },
            { date: 30, day: 'Rab', active: false },
            { date: 31, day: 'Kam', active: true },
            { date: 1, day: 'Jum', active: false },
            { date: 2, day: 'Sab', active: false },
            { date: 3, day: 'Min', active: false }
          ]
        }
      }
      
      this.loading = false
    }
  }
})

// Alternative: If you want to use a simple mock API service
export const mockDashboardAPI = {
  async getDashboardData() {
    // Simulate network delay
    await new Promise(resolve => setTimeout(resolve, 800))
    
    return {
      success: true,
      data: {
        residents: '243.000',
        developments: '87',
        head_of_families: '62.450',
        events: '24',
        social_assistances: '156',
        // ... rest of the data structure above
      }
    }
  }
}

// Usage in component (if you want to call API directly)
// import { mockDashboardAPI } from '@/services/mockAPI'
// 
// const fetchData = async () => {
//   const response = await mockDashboardAPI.getDashboardData()
//   dashboardData.value = response.data
// }