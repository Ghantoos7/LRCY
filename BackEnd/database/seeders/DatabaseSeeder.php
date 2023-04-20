<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\announcement;
use App\Models\branch;
use App\Models\comment;
use App\Models\comment_like;
use App\Models\event;
use App\Models\event_image;
use App\Models\event_type;
use App\Models\goal;
use App\Models\is_responsible;
use App\Models\like;
use App\Models\login_attempt;
use App\Models\picture;
use App\Models\post;
use App\Models\post_type;
use App\Models\program;
use App\Models\recover_request;
use App\Models\reply;
use App\Models\take;
use App\Models\training;
use App\Models\user_type;
use App\Models\volunteer_user;
use Illuminate\Database\Seeder;

use function Ramsey\Uuid\v1;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        
        /*volunteer_user::factory(50)->create();
        post::factory(20)->create();
        branch::factory(20)->create();
        comment_like::factory(20)->create();
        event_image::factory(20)->create();
        event_type::factory(20)->create();
        is_responsible::factory(20)->create();
        like::factory(20)->create();
        login_attempt::factory(20)->create();
        picture::factory(20)->create();
        recover_request::factory(20)->create();
        reply::factory(20)->create();
        take::factory(50)->create();
        training::factory(15)->create();
        goal::factory(20)->create();
        announcement::factory(20)->create();
        comment::factory(20)->create();
        event::factory(20)->create();*/

       // event_image::factory(5)->create();
        announcement::factory(20)->create();
    }
}
