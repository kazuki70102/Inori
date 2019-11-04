<template>
    <div>
        <button class="btn btn-outline-primary w-100 mb-3" @click="requestUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'requests'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function() {
            return {
                status: this.requests,
            }
        },

        methods: {
            requestUser() {
                axios.post('/request/' + this.userId)
                     .then(response => {
                         this.status = ! this.status;

                         console.log(response.data);
                     })
                     .catch(errors => {
                         if(errors.response.status == 401) {
                             window.location = 'login';
                         }
                     });
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'リクエスト済み' : 'リクエスト';
            }
        }
    }
</script>
