import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        counter: 1000
    },
    getters: {
        getCounter(state) {
            return state.counter;
        }
    },
    actions: {                                      //    this function are async  
        changeByAction({commit}, data) {
            commit('counterPlus', data)
        }
    },
    mutations: {                                    // this function are not async
        counterPlus(state, data) {
            state.counter += data;
        }
    }
})