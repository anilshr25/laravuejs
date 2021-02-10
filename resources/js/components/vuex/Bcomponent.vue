<template>
    <div class="pb-3">
        <h1 style="color:green">This is Component B Page and counter state is: {{ getCounter }}</h1>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        computed: {
           ...mapGetters(['getCounter']) //simple call function
            // ...mapGetters({
            //     'counter': 'getCounter' //OVerride the function
            // })
        },
    }
</script>