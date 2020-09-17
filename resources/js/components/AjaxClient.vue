<template>
    <div class="container">
        <h1>Ajax Client</h1>
        <h2>Config</h2>

        <div class="row">
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

        <h2>Set Attribute</h2>

        <form action="#" @submit.prevent="setCssAttribute">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <select class="form-control" v-model="cssAttribute.type">
                            <option value="0">Animation Duration</option>
                            <option value="1">Background Color</option>
                            <option value="2">Margin Left</option>
                            <option value="3">Margin Right</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="number" v-model="cssAttribute.order" class="form-control" placeholder="order">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="text" v-model="cssAttribute.value" class="form-control" placeholder="value">
                    </div>
                </div>
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
    props: {
        baseUrl: {
            type: String,
            required: true
        },
    },
    data() {
        return {
            'token' : '',
            'chatMessage' : '',
            'error' : '',
            'cssAttribute' : {
                'value' : '',
                'type' : 0,
                'order' : 0
            }
        }
    },
    methods: {
        sendChat() {
            axios.post('http://webg.test/api/sendMessage', {
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
        },
        setCssAttribute() {
            axios.post(this.baseUrl + '/setCssAttribute', {
                'value' : this.cssAttribute.value,
                'order' : this.cssAttribute.order,
                'type' : this.cssAttribute.type
            }, {
                headers : {
                    'Authorization' : 'Bearer ' + this.token
                }
            }).then(e => {

                this.error = '';
            }).catch(e => {
                this.error = e;
            })
        }
    }
}
</script>

<style scoped>

</style>
