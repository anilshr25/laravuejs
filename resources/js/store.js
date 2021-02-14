import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        counter: 1000,
        deleteModalObj: {
            deleteModal: false,
            isDeleting: false,
            deleteUrl: '',
            deleteData: null,
            index: -1,
            isDeleted: false
        },
        user: false,
    },
    getters: {
        getCounter(state) {
            return state.counter;
        },
        getDeleteModelObj(state) {
            return state.deleteModalObj
        },
        // getLoggedIn(state,user) {
        //     state.user = user
        // }

    },
    actions: {                                      //    this function are async
        changeByAction({commit}, data) {
            commit('counterPlus', data)
        }
    },
    mutations: {                                    // this function are not async
        counterPlus(state, data) {
            state.counter += data;
        },
        setDeleteModal(state, data) {
            const deleteModalObj = {
                deleteModal: false,
                isDeleting: false,
                deleteUrl: '',
                deleteData: null,
                index: -1,
                isDeleted: data
            }
            state.deleteModalObj = deleteModalObj
        },
        setDeleteData(state, data) {
            state.deleteModalObj = data
        },

        updateUser(state, data) {
            state.user = data;
        }
    }
})
