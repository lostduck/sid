import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('@/views/Home.vue'),
      meta: {
        pageTitle: 'Home',
        breadcrumb: [
          {
            text: 'Home',
            active: true,
          },
        ],
      },
    },
    {
      path: '/second-page',
      name: 'second-page',
      component: () => import('@/views/SecondPage.vue'),
      meta: {
        pageTitle: 'Second Page',
        breadcrumb: [
          {
            text: 'Second Page',
            active: true,
          },
        ],
      },
    },
    {
      path: '/news',
      name: 'news',
      component: () => import('@/views/news/List.vue'),
      meta: {
        pageTitle: 'Berita',
        breadcrumb: [
          {
            text: 'Berita',
            active: true,
          },
        ],
		resource: 'news',
    	action: 'list'
      },
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('@/views/Login.vue'),
      meta: {
        layout: 'full',
		isAuthPage: true,
      },
    },
    {
      path: '/error-404',
      name: 'error-404',
      component: () => import('@/views/error/Error404.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '*',
      redirect: 'error-404',
    },
  ],
})

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})

// New Imports
import { canNavigate } from '@/libs/acl/routeProtection'
import { isUserLoggedIn, getHomeRouteForLoggedInUser } from '@/auth/utils'

// Router Before Each hook for route protection
router.beforeEach((to, _, next) => {
	if(!to.meta.isAuthPage) {
		const isLoggedIn = isUserLoggedIn()

		if (!canNavigate(to)) {
		  // Redirect to login if not logged in
		  // ! We updated login route name here from `auth-login` to `login` in starter-kit
		  if (!isLoggedIn) return next({ name: 'login' })

		  // If logged in => not authorized
		  return next({ name: 'not-authorized' })
		}

		// Redirect if logged in
		if (to.meta.redirectIfLoggedIn && isLoggedIn) {
		  next(getHomeRouteForLoggedInUser())
		}
	}
	return next()
})

export default router
