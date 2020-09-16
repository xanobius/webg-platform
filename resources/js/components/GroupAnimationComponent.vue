<template>
    <div class="group-item">
        Gruppe {{ groupName }}
        <ul>
            <li v-for="msg in messages">{{ msg }}</li>
        </ul>
        <button @click="getChatMessage">Get em</button>
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
            'messages' : ['Moin']
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

<style scoped>

</style>
