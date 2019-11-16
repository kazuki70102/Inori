<template>
    <div class="col-md-8 bg-white border border-secondary p-4" style="height: 600px;">

        <div id="target" style="height: 420px; overflow: scroll;">
            <div v-for="m in messages" class="mb-3">
                <div v-if="m.send_user_id === matchUserId" class="d-flex">
                    <img v-bind:src="matchUserImage" width="40" height="40" class="rounded-circle mr-3">
                    <div class="balloon1-left">
                      <p v-text="m.message"></p>
                    </div>
                </div>
                <div v-else class="text-right">
                    <div class="balloon1-right mr-5">
                        <p v-text="m.message"></p>
                    </div>
                </div>
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
</template>

<script>
    export default {
        props: ['userId', 'matchUserId', 'matchUserName', 'matchUserImage', 'matchId'],

        data: function() {
            return {
                message: '',
                messages: [],
            }
        },

        mounted() {
            this.getMessages();
            this.scroll();

            Echo.channel('chat')
                .listen('MessageCreated', (e) => {
                    this.getMessages();
                    this.scroll();
                });


            console.log('Component mounted.')
        },


        methods: {
            getMessages() {
                const url = '/messages';
                const params = {
                    matchId: this.matchId,
                };
                axios.get(url, {params: params})
                     .then(response => {
                         this.messages = response.data;
                     })
            },

            send() {
                const url = '/messages';
                const params = {
                    message: this.message ,
                    match_id: this.matchId,
                    send_user_id: this.userId,
                };
                axios.post(url, params)
                     .then(response => {
                         this.message = '';
                     });
            },

            scroll() {
                $('#target').animate({scrollTop: $('#target').get(0).scrollHeight}, 'fast');
            }
        },

    }
</script>
