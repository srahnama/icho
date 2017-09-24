<template>
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reply Component</div>

                    <div  style="color: red;" class="panel-body">
                        <form v-on:submit.prevent="createReply"  >
                            <div v-bind:class="{'form-group}':true,'has-error':errors.text}">
                                <textarea type="text"  class="form-control" v-model="message.text"  placeholder="write something"></textarea>
                                <!--<span class="help-block" v-for="error in errors.text">{{ error }}</span>-->
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Tweet</button>
                            </div>
                        </form>
                        <!--{{message.id}}-->
                        <!--{{user}}-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                errors: [],
                myid : 0,
                message:{'text':''}

            }
        },

        props: ['messages','id', 'user'],
        methods: {
            createReply() {
                var id = 0;
                this.$http.post('/messages/', this.message).then(response => {
                    this.messages.push(response.data.message);//add new message to messages array
                    console.log(response.data.message);
//                    this.message={text:''};
                    this.$http.post('/reply/',[this.id,response.data.message.id]).then(response=>{
                        console.log(response.data);
                    });

                }, response => {
                    this.errors = response.data.errors;//get errors of message validation
//                    console.log(response.data.errors);
                });

            }
        },
        mounted() {
            console.log('Reply')
        },
    }
</script>
