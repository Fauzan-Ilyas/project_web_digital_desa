import Dashboard from '@/views/Dashboard.vue'
import HeadOfFamilies from '@/views/head-of-family/HeadOfFamilies.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: Dashboard,
    },
    {
      path: 'head-of-family',
      name: 'head-of-family',
      component: HeadOfFamilies,
      meta: { requiresAuth: true, Permissions: 'head-of-family-list' },
    },
    {
      path: 'head-of-family/:id',
      name: 'manage-head-of-family',
      component: HeadOfFamily,
      meta: { requiresAuth: true, Permissions: 'head-of-family-list' },
    },
    {
      path: 'head-of-family/create',
      name: 'create-head-of-family',
      component: HeadOfFamilyCreate,
      meta: { requiresAuth: true, Permissions: 'head-of-family-create' },
    }
  ],
})

export default router
