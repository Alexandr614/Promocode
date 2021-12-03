import VueRoute from 'vue-router';
import Vue from 'vue';
import UsePromocode from './components/UsePromocode';
import Admin from './components/Admin';
import WelcomeAdmin from './components/WelcomeAdmin';
import CreatePromocode from './components/CreatePromocode';
import ViewPromocodes from './components/ViewPromocodes';

Vue.use(VueRoute);

const routes = [
  {
    path: "/",
    components: {
        main: UsePromocode
    }
  },
  {
    path: "/admin",
    components: {
        main: Admin,
        admin: WelcomeAdmin
    }
  },
  {
    path: "/admin/CreatePromocode",
    components: {
        main: Admin,
        admin: CreatePromocode
    }
  },
  {
    path: "/admin/ViewPromocodes",
    components: {
        main: Admin,
        admin: ViewPromocodes
    }
  }
];

export default new VueRoute({
  mode: "history",
  routes
})
