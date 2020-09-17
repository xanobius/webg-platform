<template>
    <div class="group-item">
        <strong>Gruppe {{ groupName }}</strong>
        <div class="row">
            <div class="col-lg-7">

                <div class="group-item__ball" :style="style">
                </div>
            </div>
            <div class="col-lg-5">
                <ul class="list-group">
<!--                    <transition-group  name="chat" tag="c">-->
                        <li v-for="msg in messages" v-bind:key="msg" class="list-group-item group-item__chat-message chat-item">{{ msg }}</li>
<!--                    </transition-group>-->
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
        }
    },
    data() {
        return {
            'messages' : [],
            'ball_hover_bg' : '#00ff00',
            'ball_animation_name' : 'example',
            'ball_animation_duration' : '10s',
            'ball_animation_endH' : '0',
            'ball_animation_endV' : '0',
        }
    },
    mounted(){
        this.getChatMessage();
    },
    computed: {
        style() {
            return {
                '--ball_hover_bg' : this.ball_hover_bg,
                '--ball_animation_name' : this.ball_animation_name,
                '--ball_animation_duration' : this.ball_animation_duration,
                '--ball_animation_endH' : this.ball_animation_endH,
                '--ball_animation_endV' : this.ball_animation_endV,
                '--ball-animation-70' : 'background-color: #0000ff'
            }
        }
    },
    methods: {
        getChatMessage: function(){
            axios.get(this.getUrl).then(e => {
                this.messages = e.data.messages;
                window.setTimeout(() => this.getChatMessage(), this.pingFrequency)
                // console.log(e.data.messages);
            }).catch(e => console.log(e.message))
        },
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
         animation-name: example;
         animation-duration: var(--ball_animation_duration);
         animation-iteration-count: infinite;
     }

     &__ball:hover {
         background-color: var(--ball_hover_bg);
     }

     @keyframes example {
         0% {
             background-color: #fffbd6; // white
             margin-top: 0;
             margin-left: 125px;
         }
         20% {
             background-color: #9cd4b0; //green
             margin-top: 80px;
             margin-left: 20px;
         }
         40% {
             background-color: #f9ac90; // red
             margin-top: 160px;
             margin-left: 100px;
         }
         60% {
             background-color: #ccc3c0; // black
             margin-top: 160px;
             margin-left: 150px;

         }
         80% {
             background-color: #abe1fa; // blue
             margin-top: 80px;
             margin-left: 200px;
         }
         100% {
             background-color: #fffbd6; // white
             margin-top: 0;
             margin-left: 125px;
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
