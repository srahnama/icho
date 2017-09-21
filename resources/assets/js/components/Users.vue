<template>

        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">


                    <div class="panel-body" v-for="user in users" >
                        <div v-if=" user.id != present">
                            {{ user.name }}<hr/>
                            {{ user.id }}

                            <div v-on:click="following(user)" v-if="follow.indexOf(user.id) < 0">
                                <input type="hidden" name="id" v-model="user.id" />
                                <button type="submit" class="btn btn-primary">follow</button>

                            </div>
                            <div v-on:click="unFollowing(user)" v-else>
                                <input type="hidden" name="id" v-model="user.id" />
                                <button type="submit" class="btn btn-danger">unfollow</button>

                            </div>
                            <br/>
                        </div>
                    </div>

                </div>
            </div>
        </div>

</template>

<script>
    export default {
        data() {
            return{
                present: 1,
                user:{
                    name:''
                },
                users: [],
                follow:[]
            }
        },
        created(){

            this.fetchusers();
            this.userFollowing();

        },
        methods:{
            fetchusers(){
                this.$http.get('/users').then( response =>{
                    this.users = response.data.users;
                    this.present = response.data.present;
                    console.log(response.data.present);
                });
            },
            createuser(){
                this.$http.post('/users/',this.user).then(response =>{
                    this.users.push(response.data.user);
//                    console.log(response.data.users);
                });
            },
            userFollowing(){
                this.$http.get('/follow').then(response =>{
                    this.follow = response.data.users;
                    console.log(response.data.users);
                });
            },
            unFollowing(user){

                this.$http.delete('/follow/'+user.id).then(response => {
                    let index = this.follow.indexOf(user.id);
                    this.follow.splice(index,1);
                    console.log(response.data.message);

                });

            },
            following(user) {
                this.$http.post('/follow', user).then(response => {
                    this.follow.push(response.data.follow);
                    console.log(response.data.follow);

                });
            }

        },
        mounted() {

           // console.log(this.users);
        },
    }
</script>
