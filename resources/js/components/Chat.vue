<template>
<div class="container">
    <div v-for="m in messages">
        <span v-text="m.created_at"></span>:&nbsp;
        <span v-text="m.message"></span>
    </div>
    <div id="chat">
        <textarea v-model="message"></textarea>
        <br>
        <button type="button" @click="send">送信</button>
    </div>
</div>
</template>

<script>
    export default {
        props: [],

        data: function() {
            return {
                message: '',
                messages: []
            }
        },

        mounted() {
            this.getMessages();

            Echo.channel('chat')
                .listen('MessageCreated', (e) => {
                    this.getMessages();
                });

            console.log('Component mounted.')
        },


        methods: {
            getMessages() {
                const url = '/ajax/messages';
                axios.get(url)
                     .then(response => {
                         this.messages = response.data;
                     })
            },

            send() {
                const url = '/ajax/messages';
                const params = { message: this.message };
                axios.post(url, params)
                     .then(response => {
                         this.message = '';
                     });
            }
        },

    }
</script>
