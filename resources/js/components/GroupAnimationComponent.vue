<template>
    <div class="group-item">
        <strong>Gruppe {{ groupName }}</strong>
        <div class="row">
            <div class="col-lg-7"></div>
            <div class="col-lg-5">
                <ul class="list-group">
                    <li v-for="msg in messages" class="list-group-item group-item__chat-message">{{ msg }}</li>
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
            'messages' : []
        }
    },
    mounted(){
        this.getChatMessage();
    },
    methods: {
        getChatMessage: function(){
            console.log('clicked');
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
 }
</style>
