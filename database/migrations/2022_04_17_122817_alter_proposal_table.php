<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('ALTER TABLE `content_library` CHANGE `media_type` `media_type_id` INT(11) NOT NULL');
        DB::statement('ALTER TABLE `content_library` ADD `tags` VARCHAR(1000) NULL AFTER `advertiser_id`');


        DB::statement('CREATE TABLE `media_types` (
                        `media_type_id` INT(10) NOT NULL AUTO_INCREMENT ,
                        `media_type_name` VARCHAR(100) NOT NULL ,
                        `extension` VARCHAR(100) NOT NULL ,
                        `status` ENUM(\'active\', \'inactive\') NOT NULL ,
                        PRIMARY KEY  (`media_type_id`)
                        ) ENGINE = InnoDB');

        DB::statement("INSERT INTO `media_types` (`media_type_id`, `media_type_name`, `extension`, `status`) VALUES
                        ('1', 'Audio', '', 'active'), 
                        ('2', 'Image', '', 'active'),
                        ('3', 'Video', '', 'active')");

        DB::statement('ALTER TABLE `proposals` CHANGE `min_budget` `budget` FLOAT NULL DEFAULT NULL');
        DB::statement('ALTER TABLE `proposals` DROP `max_budget`');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
