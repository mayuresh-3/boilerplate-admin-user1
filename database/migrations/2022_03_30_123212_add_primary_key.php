<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrimaryKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_influencers_map', function (Blueprint $table) {
            DB::statement('ALTER TABLE `campaign_content_mapp` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
            DB::statement('ALTER TABLE `campaign_content_mapp` ADD UNIQUE( `campaign_id`, `content_lib_id`)');
            DB::statement('ALTER TABLE `campaign_influencers_map` ADD UNIQUE( `influencer_id`, `campaign_id`)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_influencers_map', function (Blueprint $table) {
            //
        });
    }
}
