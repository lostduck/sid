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
		isPublicPage: true,
      },
    },
    {
      path: '/news',
      name: 'news-list',
      component: () => import('@/views/news/List.vue'),
      meta: {
        pageTitle: 'List Berita',
        breadcrumb: [
          {
            text: 'Berita',
          },
          {
            text: 'List',
            active: true,
          },
        ],
		resource: 'news',
    	action: 'list'
      }
    },
	  {
		  path: '/news/add',
		  component: () => import('@/views/news/Add.vue'),
		  name: 'news-add',
		  meta: {
			  pageTitle: 'Tambah Berita',
			  breadcrumb: [
				  {
					  text: 'Berita'
				  },
				  {
					  text: 'Form',
					  active: true,
				  },
			  ],
			  resource: 'news',
			  action: 'create'
		  }
	  },
	  {
		  path: '/news/edit/:id',
		  component: () => import('@/views/news/Edit.vue'),
		  name: 'news-edit',
		  meta: {
			  pageTitle: 'Edit Berita',
			  breadcrumb: [
				  {
					  text: 'Berita',
					  active: true,
				  },
			  ],
			  resource: 'news',
			  action: 'edit'
		  }
	  },
    {
      path: '/login',
      name: 'login',
      component: () => import('@/views/Login.vue'),
      meta: {
        layout: 'full',
		isPublicPage: true,
      },
    },
    {
      path: '/error-404',
      name: 'error-404',
      component: () => import('@/views/error/Error404.vue'),
      meta: {
        layout: 'full',
		isPublicPage: true,
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
	if (!to.meta.isPublicPage) {
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
