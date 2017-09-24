<template >

    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body" >
                    <form v-on:submit.prevent="createMessage"  >
                        <div v-bind:class="{'form-group}':true,'has-error':errors.text}">
                            <textarea type="text"  class="form-control" v-model="message.text"  placeholder="write something"></textarea>
                            <span class="help-block" v-for="error in errors.text">{{ error }}</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Tweet</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <!--{{ message.text }}-->
                    <div class="panel-body" v-for="message in messages">

                        <div v-if="message.answer" class="form-group">

                            {{message.text}}
                            <span>replies </span>
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <!--{{ message.text }}-->
                                    <div class="panel-body" v-for="reply in message.messages">
                                        {{reply.text}}
                                        <div v-if="reply.user_id == user_id" class="form-group">
                                            <!--{{user.name}}-->
                                            <button v-on:click="deleteReply(message,reply)" type="submit" class="btn btn-danger">delete</button>
                                        </div>
                                        <div v-if="reply.retweeter != user_id" class="form-group">
                                            <div  class="form-group">
                                                <button v-on:click="reMessage(reply)" type="submit" class="btn btn-info">retweet</button>
                                            </div>
                                        </div>
                                        <div v-else class="form-group">
                                            <div  class="form-group">
                                                <button v-on:click="unReMessage(reply)" type="submit" class="btn btn-danger">unretweet</button>
                                            </div>
                                        </div>
                                        <div  class="form-group">
                                            <button  v-on:click="toReply(reply)" class="btn btn-primary">reply</button>
                                            <Reply  v-if="reply.reply" :messages.sync="messages" :id="reply.id" :user="user" ></Reply>

                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div v-else class="form-group">

                            {{ message.text }}

                        </div>
                        <div v-if="message.retweeter != null" class="form-group">
                            <span>retweet by : {{ message.retweeter_name }}</span>
                        </div>
                        <br/>
                        <div v-if="message.user_id == user_id" class="form-group">
                            <!--{{user.name}}-->
                            <button v-on:click="deleteMessage(message)" type="submit" class="btn btn-danger">delete</button>
                        </div>
                        <div v-if="message.retweeter != user_id" class="form-group">
                            <div  class="form-group">
                                <button v-on:click="reMessage(message)" type="submit" class="btn btn-info">retweet</button>
                            </div>
                        </div>
                        <div v-else class="form-group">
                            <div  class="form-group">
                                <button v-on:click="unReMessage(message)" type="submit" class="btn btn-danger">unretweet</button>
                            </div>
                        </div>
                        <div  class="form-group">
                            <button  v-on:click="toReply(message)" class="btn btn-primary">reply</button>
                            <Reply  v-if="message.reply" :messages.sync="messages" :id="message.id" :user="user" ></Reply>

                        </div>
                        {{ message.user_id }}
                    </div>
                </div>
            </div>

        </div>



</template>

<script>
    import Reply from './Reply.vue';

    export default {
        props:['user'],
        data() {
            return{
                to_reply:false,
                answers:[],
                user_id:[],//id of user login
                errors:[],//errors of messages for sending to store
                message:{//one message
                    text:''
                },
                messages: [],//all messages
                remessages: []
            }
        },

        components:{Reply} ,
        created(){

        this.$on('loadedMessages',function(){
            this.fetchReplies();
            this.fetchReMessages();
        });
        },
        methods: {
            fetchMessages() {//fetch messages and user id
                this.$http.get('/messages').then(response => {
                    this.messages = response.data.messages;//get all messages in database that should be seen by user
                    this.user_id = response.data.user_id;//get id of login user
                    this.$emit('loadedMessages')
                }).then(

                );





            },
            createMessage() {//store new message
                this.$http.post('/messages/', this.message).then(response => {
                    this.messages.push(response.data.message);//add new message to messages array
//                    this.message={text:''};

                }, response => {
                    this.errors = response.data.errors;//get errors of message validation
//                    console.log(response.data.errors);
                });
            },
            deleteMessage(message) {//delete message
                this.$http.delete('/messages/' + message.id).then(response => {
                    let index = this.messages.indexOf(message);//get index of message that was deleted
                    this.messages.splice(index, 1);//delete message in array messages
                    console.log(response.data);

                });

            },
            fetchReMessages() {//work like retweet
                this.$http.get('remessage').then(response => {
                    var a = response.data.messages;
                    var b = this.messages;
                    this.messages = b.concat(a);
                    // console.log(this.messages);
                });

            },
            reMessage(message) {
                this.$http.post('/remessage/', message).then(response => {
                    this.messages.push(response.data.message);
                    console.log(response.data.message);
                });
            },
            unReMessage(message) {
                this.$http.delete('/remessage/' + message.id).then(response => {
                    let index = this.messages.indexOf(message);//get index of message that was deleted
                    this.messages.splice(index, 1);

                    console.log(response.data.message);
                });
            },
            fetchReplies() {//work like retweet
                console.log(this.messages);
                for (var i = 0; i < this.messages.length; i++) {
                    this.messages[i]['reply'] = false;
                    this.messages[i]['messages'] = [];
                    if (this.messages[i]['answer']) {
                        var index = this.messages.indexOf(this.messages[i]);
                        this.$http.get('/reply/' + this.messages[i].id).then((response) => {

                            this.messages[index]['messages'] =(response.data.messages);


                        });
                    }
                }
                console.log( this.messages);


            },
            deleteReply(message,reply) {//delete message
                this.deleteMessage(reply);
                this.$http.delete('/reply/' + reply.id+'/'+message.id).then(response => {
                    //let index = this.messages.indexOf(message);//get index of message that was deleted
                    //let index1 = this.messages[index].indexOf(reply);//delete message in array messages
                 //   this.messages[index].splice(index1, 1);//delete message in array messages
                    console.log(response.data);

                });

            },
            toReply(message) {//reply to message
                var index = this.messages.indexOf(message);
                //this.$set(message.reply , !message.reply);
                this.messages[index].reply = !this.messages[index].reply;
                // console.log(!this.messages[index].reply);
                this.$forceUpdate();
                //alert(this.messages[index].reply);
            }
        },
            mounted() {

                this.fetchMessages();


                //console.log(this.messages);
            },

    }
</script>
