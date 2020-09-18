<template>
    <div>
        <h1>Websocket</h1>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" v-model="message">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select v-model="groupId" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="99">99</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <button class="btn-success btn" @click="connect">
                    Connect
                </button>
            </div>
            <div class="col-1">
                <button class="btn btn-success" :disabled=" ! connected" @click="sendText">Send</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "WebsocketClient.vue",
    data() {
        return {
            connection: null,
            message: '',
            groupId : 1,
            connected : false
        }
    },
    created() {
    },
    methods: {
        connect () {
            this.connection = new WebSocket("ws://localhost:8980?token=" + this.groupId);

            this.connection.onmessage = event => {
                console.log(event.data);
            }

            this.connection.onopen =event => {
                console.log(event);
                this.connected = true;
            }

            this.connection.onclose = event => {
                this.connected = false;

            }
        },
        sendText() {
            this.connection.send(this.message);
        }
    },
}
</script>

<style scoped>

</style>
