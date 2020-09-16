<template>
    <div>
        <h1>Ajax Client</h1>
        <h2>Config</h2>
        <p>
            <label for="url">Endpoint
                <input type="text" v-model="url" id="url">
            </label>
        </p>
        <p>
            <label for="token">Token
                <input type="text" v-model="token" id="token">
            </label>
        </p>

        <h2>Chat message</h2>
        <form action="#" @submit.prevent="sendChat">
            <input type="text" v-model="chatMessage">
            <button>Send</button>
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
