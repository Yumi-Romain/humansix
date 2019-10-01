import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'

import Login from './components/Login'
import Orders from './components/Orders'
import AddOrder from './components/AddOrder'
import E404 from './components/E404'
import App from './App'

Vue.use(VueRouter)

Vue.config.productionTip = false

const routes = [
  { path: '*', component: E404, name: 'E404' },
  { path: '/login', component: Login, name: 'Login' },
  { path: '/', component: Orders, name: 'Orders' },
  { path: '/addOrder', component: AddOrder, name: 'AddOrder' }
]

const router = new VueRouter({
  mode: 'history',
  routes,
})

router.beforeEach((to, from, next) => {
  // redirect to login if we don't have token
  if (to.path !== '/login' && !localStorage.getItem('token')) next('/login')
  else next()
})

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
