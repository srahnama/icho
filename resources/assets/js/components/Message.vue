<template>

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
                    <div class="panel-body" v-for="message in messages">
                        {{ message.text }}
                        <br/>
                        <div v-if="message.user_id == user_id" class="form-group">
                            <button v-on:click="deleteMessage(message)" type="submit" class="btn btn-danger">delete</button>
                        </div>
                        {{ message.user_id }}
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    export default {
        data() {
            return{
                user_id:[],
                errors:[],
                message:{
                    text:''
                },
                messages: []
            }
        },
        created(){
            this.fetchMessages();
        },
        methods:{
            fetchMessages(){//fetch messages and user id
                this.$http.get('/messages').then( response =>{
                    this.messages = response.data.messages;
                    this.user_id = response.data.user_id;
                });
            },
            createMessage(){//store new message
                this.$http.post('/messages/',this.message).then(response => {
                    this.messages.push(response.data.message);
//                    this.message={text:''};

                },response =>{
                    this.errors = response.data.errors;
//                    console.log(response.data.errors);
                });
            },
            deleteMessage(message){
                this.$http.delete('/messages/'+message.id).then(response=>{
                    let index = this.messages.indexOf(message);
                    this.messages.splice(index,1);
                    console.log(response.data);

                });

            }
        },
        mounted() {

            console.log(this.messages);
        },
    }
</script>
