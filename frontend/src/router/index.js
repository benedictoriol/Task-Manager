import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      component: () => import('@/stores/views/guest/LoginView.vue'),
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('@/stores/views/guest/RegisterView.vue'),
    },
    {
      path: '/task-manager',
      name: 'task-manager',
      component: () => import('@/stores/views/auth/TaskManager.vue'),
    },
  ],
})

export default router
