// import { handleError } from "@/helpers/errorHelper";
// import { axiosInstance } from "@/plugins/axios";
// import router from "@/router";
// import Cookies from "js-cookie";
// import { defineStore } from "pinia";

// export const useAuthStore = defineStore('auth',{
//     state: () => ({
//         user: null,
//         loading: false,
//         error: null,
//         success: null,
//     }),
//     getters: {
//         token: state => Cookies.get('token'),
//     },
//     actions: {
//         async login(credentials) {
//             this.loading = true
//             try {
//                 const response = await axiosInstance.post('/login', credentials)
//                 const token = response.data.token
//                 Cookies.set('token', token)
//                 this.success = 'Login successful'
//                 router.push({ name: 'dashboard' })
//             } catch (error) {
//                 this.error = handleError(error)
//             } finally {
//                 this.loading = false
//             }
//         },
//         async logout() {
//             this.loading = true

//             try {
//                 await axiosInstance.post('/logout')

//                 Cookies.remove('token')

//                 router.push({ name: 'login' })

//                 this.user = null
//                 this.error = null

//                 this.success = 'Logout successful'
//             } catch (error) {
//                 this.error = handleError(error)
//             } finally {
//                 this.loading = false
//             }
//         },
//         async checkAuth() {
//             this.loading = true
//             try {
//                 const response = await axiosInstance.get('/me')
//                 this.user = response.data.data
//                 return this.user
//             } catch (error) {
//                 if (error.response && error.response.status === 401) {
//                 Cookies.remove('token')
//                 this.user = null
//                 throw error
//                 }
//             } 
//             this.loading = false
//         },
//     },
// })

// stores/auth.js
import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    isAuthenticated: false,
    loading: false,
    token: null
  }),

  getters: {
    isLoggedIn: (state) => state.isAuthenticated && state.user !== null,
    userRole: (state) => state.user?.role || null,
    userName: (state) => state.user?.name || null
  },

  actions: {
    // Initialize auth state (call this on app startup)
    async initAuth() {
      this.loading = true
      
      // Check if user data exists in localStorage
      const savedUser = localStorage.getItem('user')
      const savedToken = localStorage.getItem('token')
      
      if (savedUser && savedToken) {
        this.user = JSON.parse(savedUser)
        this.token = savedToken
        this.isAuthenticated = true
      } else {
        // Set dummy user data for development
        await this.setDummyUser()
      }
      
      this.loading = false
    },

    // Set dummy user data
    async setDummyUser() {
      // Simulate API call delay
      await new Promise(resolve => setTimeout(resolve, 500))
      
      const dummyUsers = [
        {
          id: 1,
          name: 'Budi Santoso',
          email: 'budi.santoso@desa.id',
          role: 'Kepala Desa',
          avatar: '@/assets/images/photos/photo-1.png',
          phone: '+62812-3456-7890',
          address: 'Jl. Desa Makmur No. 1',
          join_date: '2023-01-15',
          permissions: ['all']
        },
        {
          id: 2,
          name: 'Siti Nurhaliza',
          email: 'siti.nurhaliza@desa.id',
          role: 'Sekretaris Desa',
          avatar: '@/assets/images/photos/photo-2.png',
          phone: '+62813-4567-8901',
          address: 'Jl. Desa Makmur No. 5',
          join_date: '2023-03-20',
          permissions: ['manage_residents', 'manage_events', 'view_reports']
        },
        {
          id: 3,
          name: 'Ahmad Fauzi',
          email: 'ahmad.fauzi@desa.id',
          role: 'Staff Administrasi',
          avatar: '@/assets/images/photos/photo-3.png',
          phone: '+62814-5678-9012',
          address: 'Jl. Desa Makmur No. 10',
          join_date: '2023-06-10',
          permissions: ['manage_residents', 'manage_applications']
        },
        {
          id: 4,
          name: 'Dewi Kartika',
          email: 'dewi.kartika@desa.id',
          role: 'Bendahara',
          avatar: '@/assets/images/photos/photo-4.png',
          phone: '+62815-6789-0123',
          address: 'Jl. Desa Makmur No. 15',
          join_date: '2023-02-28',
          permissions: ['manage_finance', 'manage_social_assistance', 'view_reports']
        },
        {
          id: 5,
          name: 'Raden Wijaya',
          email: 'raden.wijaya@desa.id',
          role: 'Koordinator Pembangunan',
          avatar: '@/assets/images/photos/photo-5.png',
          phone: '+62816-7890-1234',
          address: 'Jl. Desa Makmur No. 20',
          join_date: '2023-04-15',
          permissions: ['manage_development', 'manage_applications', 'view_reports']
        }
      ]
      
      // Randomly select a user or use the first one (Kepala Desa)
      const selectedUser = dummyUsers[0] // You can change index or randomize
      
      this.user = selectedUser
      this.token = 'dummy-jwt-token-' + selectedUser.id
      this.isAuthenticated = true
      
      // Save to localStorage for persistence
      localStorage.setItem('user', JSON.stringify(selectedUser))
      localStorage.setItem('token', this.token)
    },

    // Login action
    async login(credentials) {
      this.loading = true
      
      try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1000))
        
        // Mock login validation
        const mockCredentials = {
          email: 'admin@desa.id',
          password: 'password123'
        }
        
        if (credentials.email === mockCredentials.email && 
            credentials.password === mockCredentials.password) {
          
          await this.setDummyUser()
          return { success: true, message: 'Login berhasil!' }
        } else {
          throw new Error('Email atau password salah')
        }
      } catch (error) {
        return { 
          success: false, 
          message: error.message || 'Login gagal, silakan coba lagi' 
        }
      } finally {
        this.loading = false
      }
    },

    // Logout action
    async logout() {
      this.loading = true
      
      try {
        // Simulate API call to logout
        await new Promise(resolve => setTimeout(resolve, 500))
        
        // Clear user data
        this.user = null
        this.token = null
        this.isAuthenticated = false
        
        // Clear localStorage
        localStorage.removeItem('user')
        localStorage.removeItem('token')
        
        // Redirect to login page
        const router = useRouter()
        router.push('/login')
        
        return { success: true, message: 'Logout berhasil!' }
      } catch (error) {
        return { 
          success: false, 
          message: 'Logout gagal, silakan coba lagi' 
        }
      } finally {
        this.loading = false
      }
    },

    // Update user profile
    async updateProfile(profileData) {
      this.loading = true
      
      try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 800))
        
        // Update user data
        this.user = { ...this.user, ...profileData }
        
        // Save to localStorage
        localStorage.setItem('user', JSON.stringify(this.user))
        
        return { success: true, message: 'Profile berhasil diperbarui!' }
      } catch (error) {
        return { 
          success: false, 
          message: 'Gagal memperbarui profile' 
        }
      } finally {
        this.loading = false
      }
    },

    // Change password
    async changePassword(passwordData) {
      this.loading = true
      
      try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1000))
        
        // Mock password validation
        if (passwordData.currentPassword !== 'password123') {
          throw new Error('Password lama tidak sesuai')
        }
        
        if (passwordData.newPassword !== passwordData.confirmPassword) {
          throw new Error('Konfirmasi password tidak sesuai')
        }
        
        return { success: true, message: 'Password berhasil diubah!' }
      } catch (error) {
        return { 
          success: false, 
          message: error.message || 'Gagal mengubah password' 
        }
      } finally {
        this.loading = false
      }
    },

    // Check if user has specific permission
    hasPermission(permission) {
      if (!this.user || !this.user.permissions) return false
      return this.user.permissions.includes('all') || 
             this.user.permissions.includes(permission)
    },

    // Switch user (for testing different roles)
    async switchUser(userId) {
      const users = [
        { id: 1, name: 'Budi Santoso', role: 'Kepala Desa' },
        { id: 2, name: 'Siti Nurhaliza', role: 'Sekretaris Desa' },
        { id: 3, name: 'Ahmad Fauzi', role: 'Staff Administrasi' },
        { id: 4, name: 'Dewi Kartika', role: 'Bendahara' },
        { id: 5, name: 'Raden Wijaya', role: 'Koordinator Pembangunan' }
      ]
      
      const selectedUser = users.find(u => u.id === userId)
      if (selectedUser) {
        this.user = { ...this.user, ...selectedUser }
        localStorage.setItem('user', JSON.stringify(this.user))
      }
    }
  }
})

// Composable untuk menggunakan auth di component
export const useAuth = () => {
  const authStore = useAuthStore()
  
  return {
    ...storeToRefs(authStore),
    ...authStore
  }
}