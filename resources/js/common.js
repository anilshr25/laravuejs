import axios from "axios"

export default {
    data() {
        return {

        }
    },
    methods: {
       async callApi(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataObj
                });
                
            } catch (er) {
                console.log(er.response)
            }
        },

        info (desc, title="Hey") {
            this.$Notice.info({
                title: title,
                desc: desc
            });
        },
        
        success (desc, title="Great!") {
            this.$Notice.success({
                title: title,
                desc: desc
            });
        },
        
        warning (desc, title="Ooops!") {
            this.$Notice.warning({
                title: title,
                desc: desc
            });
        },
        
        error (desc, title="Ooops") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        },

        swrong (desc= "Something Went Wrong", title="Ooops") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        },
    },
}