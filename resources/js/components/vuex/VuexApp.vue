<template>
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Testing Vuex</h3>
        <div class="card shadow">
            <div class="card-body">
                <h1>This is Vuex Page</h1>
                <h1 class="pb-3">Current State of counter in Vuex Page: {{ counter }}</h1>
                <Acomp></Acomp>
                <Bcomp></Bcomp>
                <Ccomp></Ccomp>
                <Button type="primary" @click="changeCounter">Change Counter</Button>
            </div>
        </div>
    </div>
</template>

<script>
    import Acomp from './Acomponent'
    import Bcomp from './Bcomponent'
    import Ccomp from './Ccomponent'

    import {mapGetters} from 'vuex'

    export default {
        data() {
            return {
                
            }
        },

        computed: {
           // ...mapGetters(['getCounter']) //simple call function
            ...mapGetters({
                'counter': 'getCounter' //OVerride the function
            })
        },

        methods: {
            changeCounter(){
                this.$store.dispatch('changeByAction', 1) // calling action function
                // this.$store.commit('counterPlus', 1)  // calling mutation function
            },
            runWhenCounterChange() {
                console.log('i am running based on each changes happening');
            }
        },

        components: {
            Acomp,
            Bcomp,
            Ccomp,
        },
        
        watch: {
            counter(value) {
                console.log('Counter is changing', value);
                this.runWhenCounterChange();
            }
        }
    }
</script>