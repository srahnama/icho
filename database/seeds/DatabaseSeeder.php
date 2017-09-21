<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        for($i=1,$j=15;$i<=15;$i++,$j--){
            //'users' table seeder
            DB::table('users')->insert([
                'name'     => str_random(10),
                'email'    => str_random(10).'@gmail.com',
                'password' => bcrypt('secret'),

            ]);

            //'messages' table
            DB::table('messages')->insert([
                'text'     => str_random(100),
                'user_id'    => ($i),
            ]);

        }
        for($i=1,$j=15;$i<=15;$i++,$j--){

            //'messages' table
            DB::table('message_replies')->insert([
                'text'     => str_random(100),
                'message_id' => ($j),
                'user_id'    => ($i),
            ]);
            DB::table('message_retweets')->insert([
                'message_id' => ($j),
                'user_id'    => ($i),
            ]);
            DB::table('like_messages')->insert([
                'message_id' => ($j),
                'user_id'    => ($i),
            ]);
            DB::table('message_mentions')->insert([
                'message_id' => ($j),
                'user_id'    => ($i),
            ]);
            DB::table('follow_users')->insert([
                'follow_user_id' => ($j),
                'user_id'        => ($i),
            ]);
            if($i==1){
                DB::table('roles')->insert([
                    'role' => 1,
                    'user_id'        => ($i),
                ]);
            }
            else{
                DB::table('roles')->insert([
                    'role' => 2,
                    'user_id'        => ($i),
                ]);
            }

        }

    }
}
