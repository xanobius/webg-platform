<template>
    <div class="group-item">
        <strong>{{ groupName }}</strong>
        <div class="row">
            <div class="col-lg-7">

                <div class="group-item__ball" :style="style">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" :id="modeswitch_id" v-model="ajax" @click="modeChange">
                    <label class="custom-control-label" :for="modeswitch_id">
                        {{ mode_label }} {{ ws_connection }}
                    </label>
                </div>
                <ul class="list-group">
                    <li v-if="ajax" v-for="msg in messages" v-bind:key="msg" class="list-group-item group-item__chat-message chat-item">{{ msg }}</li>

                    <li v-if="! ajax" v-for="msg in ws_chats" class="list-group-item group-item__chat-message chat-item">{{ msg }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        pingFrequency: {
            type: Number,
            default: 5000
        },
        groupName : {
            type: String,
            required: true
        },
        userId: {
            type: Number,
            required: true
        },
        getUrl: {
            type: String,
            required: true
        },
        wsUrl : {
            type: String,
            required: true
        }
    },
    data() {
        return {
            'ws_con' : null,
            'ws_chats' : [],
            'connected' : false,
            'ajax' : true,
            'version' : 0,
            'messages' : [],

            'ball_animation_name' : 'mtg',
            'ball_animation_duration' : '5s',

            'ball_bgcs' : ['#ff0000', '#ff0000', '#ff0000', '#ff0000', '#ff0000'],
            'ball_hor' : ['0', '0', '0', '0', '0'],
            'ball_ver' : ['0', '0', '0', '0', '0'],
        }
    },
    mounted(){
        this.getChatMessage();
    },
    computed: {
        ws_connection(){
            return this.ajax ? '' : (
                this.connected ? '(ok)' : '(nok)'
            )
        },
        modeswitch_id(){
            return 'modeswitch_' + this.userId;
        },
        mode_label() {
            return this.ajax ? 'Ajax Mode' : 'Websocket Mode';
        },
        style() {
            return {
                '--ball_bg' : this.ball_bgcs[0],
                '--ball_ver' : this.ball_ver[0],
                '--ball_hor' : this.ball_hor[0],

                '--ball_animation_name' : this.ball_animation_name,
                '--ball_animation_duration' : this.ball_animation_duration,

                '--ball_ver_20' : this.ball_ver[1],
                '--ball_hor_20' : this.ball_hor[1],
                '--ball_color_20' : this.ball_bgcs[1],

                '--ball_ver_40' : this.ball_ver[2],
                '--ball_hor_40' : this.ball_hor[2],
                '--ball_color_40' : this.ball_bgcs[2],

                '--ball_ver_60' : this.ball_ver[3],
                '--ball_hor_60' : this.ball_hor[3],
                '--ball_color_60' : this.ball_bgcs[3],

                '--ball_ver_80' : this.ball_ver[4],
                '--ball_hor_80' : this.ball_hor[4],
                '--ball_color_80' : this.ball_bgcs[4],
                'version' : this.version
            }
        }
    },
    methods: {
        connectToWebsocket: function () {
            this.ws_con = new WebSocket("ws://" + this.wsUrl + "?token=" + this.userId);

            this.ws_con.onmessage = event => {
                this.ws_chats = [event.data, ...this.ws_chats];
            }

            this.ws_con.onopen =event => {
                this.connected = true;
            }

            this.ws_con.onclose = event => {
                this.connected = false;
                this.ws_con = null;
            }
        },
        modeChange: function() {
            if (this.ajax && ! this.ws_con)
                this.connectToWebsocket()

            this.ajax = !this.ajax;

            if(this.ajax)
                this.getChatMessage()
        },
        getChatMessage: function(){
            if ( ! this.ajax)  return;
            axios.get(this.getUrl).then(e => {
                this.messages = e.data.messages;
                this.assignCssData(e.data.cssData);
                window.setTimeout(() => this.getChatMessage(), this.pingFrequency)
            }).catch(e => console.log(e.message))
        },
        assignCssData: function(data){
            if(data.length == 0) return;

            data.forEach(css => {
                if(css.type == 0){
                    this.ball_animation_duration = css.value;
                }
                if(css.type == 1){
                    this.ball_bgcs[css.order] = css.value;
                }
                if(css.type == 2){
                    this.ball_hor[css.order] = css.value;
                }
                if(css.type == 3){
                    this.ball_ver[css.order] = css.value;
                }
            });
            this.version++;
        }
    },
}
</script>

<style scoped lang="scss">
 .group-item {
     background-color: #d7d6d6;
     border: 1px solid #000000;
     border-radius: 10px;
     margin: 10px;
     padding: 15px;
     @media screen and (min-width: 992px){
         height: 28vh;
         overflow: hidden;
     }
     &__chat-message{
        word-break: break-word;
     }

     &__ball {
         background-color: rgb(255, 0, 0);
         width: 2rem;
         height: 2rem;
         border-radius: 1rem;
         border: 1px solid #555555;
         animation-name: mtg;
         animation-duration: var(--ball_animation_duration);
         animation-iteration-count: infinite;
     }

     &__ball:hover {
         background-color: var(--ball_hover_bg);
     }

     @keyframes mtg {
         0% {
             background-color: var(--ball_bg); // white
             margin-top: var(--ball_ver);
             margin-left: var(--ball_hor);
         }
         20% {
             background-color: var(--ball_color_20); //green
             margin-top: var(--ball_ver_20);
             margin-left: var(--ball_hor_20);
         }
         40% {
             background-color: var(--ball_color_40); // red
             margin-top: var(--ball_ver_40);
             margin-left: var(--ball_hor_40);
         }
         60% {
             background-color: var(--ball_color_60); // black
             margin-top: var(--ball_ver_60);
             margin-left: var(--ball_hor_60);
         }
         80% {
             background-color: var(--ball_color_80); // blue
             margin-top: var(--ball_ver_80);
             margin-left: var(--ball_hor_80);
         }
         100% {
             background-color: var(--ball_bg); // white
             margin-top: var(--ball_ver);
             margin-left: var(--ball_hor);
         }
     }

     .chat-item {
         display: inline-block;
         margin-right: 10px;
     }
     .chat-enter-active, .chat-leave-active {
         transition: all 1s;
     }
     .chat-enter, .chat-leave-to /* .list-leave-active below version 2.1.8 */ {
         opacity: 0;
         transform: translateY(30px);
     }
 }
</style>
