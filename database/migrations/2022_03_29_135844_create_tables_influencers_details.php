<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesInfluencersDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('influencers_details', function (Blueprint $table) {
            DB::statement('CREATE TABLE `influencers_details` (
                          `id` int(11) NOT NULL,
                          `user_id` int(11) NOT NULL,
                          `social_media_id` int(11) NOT NULL,
                          `link` varchar(191) DEFAULT NULL,
                          `followers` int(11) DEFAULT NULL,
                          `engagement` float DEFAULT NULL,
                          `videos` int(11) DEFAULT NULL,
                          `avg_views_per_video` float DEFAULT NULL,
                          `avg_views_per_video_week` float DEFAULT NULL,
                          `email` varchar(191) DEFAULT NULL,
                          `status` enum(\'active\',\'inactive\') NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

            DB::statement('ALTER TABLE `influencers_details`
              ADD PRIMARY KEY (`id`),
              ADD KEY `id` (`id`),
              ADD KEY `user_id_fk_adv_user0` (`user_id`)');

            DB::statement('ALTER TABLE `influencers_details`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('influencers_details', function (Blueprint $table) {
            //
        });
    }
}
