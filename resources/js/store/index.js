import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersistence from 'vuex-persist'
Vue.use(Vuex)

// stored in localStorage, can get using localStorage.getItem("vuex")
const vuexLocal = new VuexPersistence({
    storage: window.localStorage
})

// use this.$store.state.XXX to access the variables
export default new Vuex.Store({
    state: {
        logged_in:false, // use this variable to check log in status

    },
    plugins:[vuexLocal.plugin]
})
