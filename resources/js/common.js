export default{
    data(){
        return {

        }
    },
    methods: {
        async callApi(method, url, dataObject){
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataObject
                  });
            } catch (e) {
                return e.response;
            }
        },
        i (desc, title="Hey") {
            this.$Notice.info({
                title: title,
                desc: desc
            });
        },
        s (desc, title="Great!") {
            this.$Notice.success({
                title: title,
                desc: desc
            });
        },
        w (desc, title="Oops!") {
            this.$Notice.warning({
                title: title,
                desc: desc
            });
        },
        e (desc, title="Oops") { // something went wrong
            this.$Notice.error({
                title: title,
                desc: desc
            });
        },
        swr (desc="Something went wrong! Please try again.", title="Oops") { // something went wrong
            this.$Notice.error({
                title: title,
                desc: desc
            });
        }
    },
}