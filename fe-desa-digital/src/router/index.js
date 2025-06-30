import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "@/stores/auth";

import Auth from "@/layouts/Auth.vue";
import Main from "@/layouts/Main.vue";
import Dashboard from "@/views/Dashboard.vue";
import Login from "@/views/Login.vue";

import HeadOfFamilies from "@/views/head-of-family/HeadOfFamilies.vue";
import HeadOfFamily from "@/views/head-of-family/HeadOfFamily.vue";
import HeadOfFamilyCreate from "@/views/head-of-family/HeadOfFamilyCreate.vue";

import SocialAssistances from "@/views/social-assistance/SocialAssistances.vue";
import SocialAssistancesEdit from "@/views/social-assistance/SocialAssistancesEdit.vue";
import SocialAssistancesCreate from "@/views/social-assistance/SocialAssistancesCreate.vue";
import SocialAssistanceRecipients from "@/views/social-assistance/SocialAssistanceRecipients.vue";

import Developments from "@/views/development/Developments.vue";
import Development from "@/views/development/Development.vue";
import DevelopomentEdit from "@/views/development/DevelopmentEdit.vue";

import Error403 from "@/views/Error403.vue";
import NotFound from "@/views/NotFound.vue";
import FamilyMemberCreate from "@/views/family-member/FamilyMemberCreate.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      component: Main,
      children: [
        {
          path: "",
          name: "dashboard",
          component: Dashboard,
          meta: { requiresAuth: true, permission: "dashboard-menu" },
        },
        {
          path: "family-member",
          name: "family-member",
          component: FamilyMembers,
          meta: { requiresAuth: true, permission: "family-member-list" },
        },
        {
          path: "family-member/:id",
          name: "manage-family-member",
          component: FamilyMember,
          meta: { requiresAuth: true, permission: "family-member-list" },
        },
        {
          path: "family-member/create",
          name: "create-family-member",
          component: FamilyMemberCreate,
          meta: { requiresAuth: true, permission: "family-member-create" },
        },
        {
          path: "head-of-family",
          name: "head-of-family",
          component: HeadOfFamilies,
          meta: { requiresAuth: true, permission: "head-of-family-list" },
        },
        {
          path: "head-of-family/:id",
          name: "manage-head-of-family",
          component: HeadOfFamily,
          meta: { requiresAuth: true, permission: "head-of-family-list" },
        },
        {
          path: "head-of-family/create",
          name: "create-head-of-family",
          component: HeadOfFamilyCreate,
          meta: { requiresAuth: true, permission: "head-of-family-create" },
        },

        {
          path: "social-assistance",
          name: "social-assistance",
          component: SocialAssistances,
          meta: { requiresAuth: true, permission: "social-assistance-list" },
        },
        {
          path: "social-assistance/create",
          name: "create-social-assistance",
          component: SocialAssistancesCreate,
          meta: { requiresAuth: true, permission: "social-assistance-create" },
        },
        {
          path: "social-assistance/edit/:id",
          name: "edit-social-assistance",
          component: SocialAssistancesEdit,
          meta: { requiresAuth: true, permission: "social-assistance-edit" },
        },
        {
          path: "social-assistance/:id",
          name: "manage-social-assistance",
          component: SocialAssistances,
          meta: { requiresAuth: true, permission: "social-assistance-list" },
        },

        {
          path: "social-assistance-recipient",
          name: "social-assistance-recipient",
          component: SocialAssistanceRecipients,
          meta: {
            requiresAuth: true,
            permission: "social-assistance-recipient-list",
          },
        },
        {
          path: "social-assistance-recipient/:id",
          name: "manage-social-assistance-recipient",
          component: SocialAssistanceRecipients,
          meta: {
            requiresAuth: true,
            permission: "social-assistance-recipient-list",
          },
        },

        {
          path: "development",
          name: "development",
          component: Developments,
          meta: { requiresAuth: true, permission: "development-list" },
        },
        {
          path: "development/:id",
          name: "manage-development",
          component: Development,
          meta: { requiresAuth: true, permission: "development-list" },
        },
        {
          path: "development/edit/:id",
          name: "edit-development",
          component: DevelopomentEdit,
          meta: { requiresAuth: true, permission: "development-edit" },
        },
        {
          path: "development/create",
          name: "create-development",
          component: DevelopmentCreate,
          meta: { requiresAuth: true, permission: "development-create" },
        },
      ],
    },
    {
      path: "/login",
      component: Auth,
      children: [
        {
          path: "",
          name: "login",
          component: Login,
          meta: { requiresUnauth: true },
        },
      ],
    },
    { path: "/403", name: "Error403", component: Error403 },
    { path: "/:pathMatch(.*)*", name: "NotFound", component: NotFound },
  ],
});

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore();

  if (to.meta.requiresAuth) {
    try {
      if (!authStore.user) {
        await authStore.checkAuth();
      }

      const userPermissions = authStore.user?.permissions || [];

      if (to.meta.permission && !userPermissions.includes(to.meta.permission)) {
        next({ name: "Error403" });
        return;
      }

      next();
    } catch (error) {
      next({ name: "login" });
    }
  } else if (to.meta.requiresUnauth && authStore.token) {
    next({ name: "dashboard" });
  } else {
    next();
  }
});

export default router;
