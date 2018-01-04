<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Gigtype;
use App\Notification;
use App\Gig;
use App\Gig_question;
use App\Gig_addon;
use App\Client_company_info;

class CnerrDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        DB::table('users')->delete();
        DB::table('gigtypes')->delete();


        $users = array(
            ['name' => 'Ryan Chenkie', 'username' => 'RyanChenkie', 'email' => 'admin@admin.com', 'password' => Hash::make('secret'), 'speaks' => 'French', 'type' => 'admin'],
            ['name' => 'Chris Sevilleja', 'username' => 'ChrisSevilleja', 'email' => 'chris@scotch.io', 'password' => Hash::make('secret'), 'speaks' => 'English, Arabic', 'type' => 'user'],
            ['name' => 'Holly loyd', 'username' => 'HollyLloyd', 'email' => 'holly@scotch.io', 'password' => Hash::make('secret'), 'speaks' => 'Chinese, English', 'type' => 'user'],
            ['name' => 'Adnan Kukic', 'username' => 'AdnanKukic', 'email' => 'adnan@scotch.io', 'password' => Hash::make('secret'), 'speaks' => 'Japanese', 'type' => 'user'],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }



        $gigTypes = array(
            ['user_id' => 1, 'slug' => 'graphics_design', 'name' => 'Graphics & Design'],
            ['user_id' => 1, 'slug' => 'online_marketing', 'name' => 'Online Marketing'],
            ['user_id' => 1, 'slug' => 'writing_translation', 'name' => 'Writing & Translation'],
            ['user_id' => 1, 'slug' => 'video_animation', 'name' => 'Video & Animation'],
            ['user_id' => 1, 'slug' => 'music_audio', 'name' => 'Music & Audio'],
            ['user_id' => 1, 'slug' => 'programming_tech', 'name' => 'Programming & Tech'],
            ['user_id' => 1, 'slug' => 'advertising', 'name' => 'Advertising'],
            ['user_id' => 1, 'slug' => 'business', 'name' => 'Business'],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($gigTypes as $gigType)
        {
            Gigtype::create($gigType);
        }



        $notifications = array(
            ['user_id' => 1, 'message' => 'You have notification 1'],
            ['user_id' => 2, 'message' => 'You have notification 2'],
            ['user_id' => 3, 'message' => 'You have notification 3'],
            ['user_id' => 4, 'message' => 'You have notification 4'],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($notifications as $notification)
        {
            Notification::create($notification);
        }



        Model::reguard();
    }
}
