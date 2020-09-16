<template>
    <div class="container">
        <h1>Ajax Client</h1>
        <h2>Config</h2>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="url">Endpoint</label>
                    <input type="text" v-model="url" id="url" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="token">Token</label>
                    <input type="text" v-model="token" id="token" class="form-control">
                </div>
            </div>
        </div>

        <h2>Chat message</h2>

        <form action="#" @submit.prevent="sendChat">
            <div class="form-group">
                <input v-model="chatMessage" class="form-control" />
            </div>
            <button class="btn btn-success">Send</button>
        </form>

        <div class="error" v-if="error">
            {{ error }}
        </div>
    </div>
</template>

<script>
export default {
    name: "AjaxClient.vue",
    data() {
        return {
            'url' : 'http://webg.test/api/sendMessage',
            'token' : '',
            'chatMessage' : '',
            'error' : ''
        }
    },
    methods: {
        sendChat() {
            axios.post(this.url, {
                'message' : this.chatMessage
            }, {
                headers : {
                    'Authorization' : 'Bearer ' + this.token
                }
            }).then(e => {
                this.chatMessage = '';
                this.error = '';
            }).catch(e => {
                this.error = e;
            });
        }
    }
}
</script>

<style scoped>

</style>
