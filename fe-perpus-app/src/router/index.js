import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/AuthStore'
import HomeView from '../views/HomeView.vue'
import CategoriesView from '@/views/CategoriesView.vue'
import BooksView from '@/views/BooksView.vue'
import LoginView from '@/views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'
import ProfileView from '@/views/ProfileView.vue'
import AdminView from '@/views/AdminView.vue'
import BooksAdminView from '@/views/BooksAdminView.vue'
import CategoriesAdminView from '@/views/CategoriesAdminView.vue'
import BorrowsView from '@/views/BorrowsView.vue'
import CreateBooksView from '@/views/CreateBooksView.vue'
import EditBooksView from '@/views/EditBooksView.vue'
import CreateCategoriesView from '@/views/CreateCategoriesView.vue'
import EditCategoriesView from '@/views/EditCategoriesView.vue'
import RolesAdminView from '@/views/RolesAdminView.vue'
import EditRolesView from '@/views/EditRolesView.vue'
import CreateRolesView from '@/views/CreateRolesView.vue'
import DetailBooksView from '@/views/DetailBooksView.vue'
import DetailCategoriesView from '@/views/DetailCategoriesView.vue'
import CreateBorrowView from '@/views/CreateBorrowView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'Login',
      component: LoginView,
      meta: { isAuthTrue: true }
    },
    {
      path: '/register',
      name: 'Register',
      component: RegisterView,
      meta: { isAuthTrue: true }
    },
    {
      path: '/profile',
      name: 'Profile',
      component: ProfileView,
      meta: { isVerifikasi: true }
    },
    {
      path: '/books',
      name: 'Books',
      component: BooksView
    },
    {
      path: '/books/:id',
      name: 'DetailBooks',
      component: DetailBooksView
    },
    {
      path: '/category',
      name: 'Categories',
      component: CategoriesView
    },
    {
      path: '/category/:id',
      name: 'DetailCategories',
      component: DetailCategoriesView
    },
    {
      path: '/adminPage',
      name: 'AdminPage',
      component: AdminView,
      meta: { isAdmin: true }
    },
    {
      path: '/booksAdmin',
      name: 'BooksAdmin',
      component: BooksAdminView,
      meta: { isAdmin: true }
    },
    {
      path: '/categoriesAdmin',
      name: 'CategoriesAdmin',
      component: CategoriesAdminView,
      meta: { isAdmin: true }
    },
    {
      path: '/borrows',
      name: 'Borrows',
      component: BorrowsView,
      meta: { isAdmin: true }
    },
    {
      path: '/create-book',
      name: 'CreateBook',
      component: CreateBooksView,
      meta: { isAdmin: true }
    },
    {
      path: '/books/:id/edit',
      name: 'EditBooks',
      component: EditBooksView,
      meta: { isAdmin: true }
    },
    {
      path: '/create-category',
      name: 'CreateCategory',
      component: CreateCategoriesView,
      meta: { isAdmin: true }
    },
    {
      path: '/category/:id/edit',
      name: 'EditCategory',
      component: EditCategoriesView,
      meta: { isAdmin: true }
    },
    {
      path: '/rolesAdmin',
      name: 'RolesAdmin',
      component: RolesAdminView,
      meta: { isAdmin: true }
    },
    {
      path: '/create-role',
      name: 'CreateRole',
      component: CreateRolesView,
      meta: { isAdmin: true }
    },
    {
      path: '/role/:id/edit',
      name: 'EditRole',
      component: EditRolesView,
      meta: { isAdmin: true }
    },
    {
      path: '/create-borrow/:id',
      name: 'CreateBorrow',
      component: CreateBorrowView,
      meta: { isVerifikasi: true }
    },

  ]
})

router.beforeEach(async (to, from) => {
  const authStore = await useAuthStore()
  
  if (to.meta.isAuthTrue && authStore.tokenUser) {
    alert("Anda sudah login")

    return {
      path: '/'
    }
  }

  if (to.meta.isVerifikasi && !authStore.currentUser.email_verified_at) {
    alert("Anda belum terverifikasi, silahkan hubungi admin untuk verifikasi")

    return {
      path: '/'
    }
  }

  if (to.meta.isAuth && !authStore.tokenUser) {
    alert("Anda belum login")

    return {
      path: '/'
    }
  }

  if (to.meta.isAdmin && authStore.currentUser.role.name === 'user') {
    alert("Anda bukan admin")
    return {
      path: '/'
    }
  }
})

export default router
