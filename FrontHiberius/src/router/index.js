import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/driver',
      name: 'driver',
      component: () => import('../views/DriverView.vue')
    },
    {
      path: '/vehicle',
      name: 'vehicle',
      component: () => import('../views/VehicleView.vue')
    },

    {
      path: '/trip',
      name: 'trip',
      component: () => import('../views/TripView.vue')

    }
  ]
})

export default router
