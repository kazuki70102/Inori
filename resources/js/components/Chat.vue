<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-3 bg-white border border-secondary p-4" style="height: 600px;">

            <div style="height: 420px; overflow-y: scroll;">
                <div v-for="m in messages">
                    <span v-text="m.created_at"></span>:&nbsp;
                    <span v-text="m.message"></span>
                </div>
            </div>
            <div id="chat" class="bg-white" style="height: 150px;">
                <div class="border border-secondary w-100">
                    <div class="border-bottom border-secondary p-1 text-right">
                        <button @click="send" class="btn btn-primary px-1 py-0">送信</button>
                    </div>
                    <textarea class="w-100 border-0 p-2 "
                              v-model="message"
                              style="height: 100px; resize: none; outline: none;">
                    </textarea>
                </div>
            </div>

        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['userId', 'matchUserId'],

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
                const url = '/messages';
                axios.get(url)
                     .then(response => {
                         this.messages = response.data;
                     })
            },

            send() {
                const url = '/messages';
                const params = {
                    message: this.message ,
                    send_user_id: this.userId,
                    recieve_user_id: this.matchUserId
                };
                axios.post(url, params)
                     .then(response => {
                         this.message = '';
                     });
            }
        },

    }
</script>
