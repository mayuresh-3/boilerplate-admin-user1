<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //  $createTableSqlString = ( file_get_contents( "test_ads_db_import.sql" ) );
            // DB::statement("'".$createTableSqlString."'");


            DB::statement('CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `contact_no_1` varchar(45) DEFAULT NULL,
  `contact_no_2` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');


            /*    DB::statement('CREATE TABLE `admins` (
       `id` bigint(20) UNSIGNED NOT NULL,
       `name` varchar(255)  NOT NULL,
       `email` varchar(255)  NOT NULL,
       `email_verified_at` timestamp NULL DEFAULT NULL,
       `password` varchar(255)  NOT NULL,
       `remember_token` varchar(100)  DEFAULT NULL,
       `created_at` timestamp NULL DEFAULT NULL,
       `updated_at` timestamp NULL DEFAULT NULL
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ');*/


            DB::statement('CREATE TABLE `admin_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');


            DB::statement('INSERT INTO `admin_details` (`id`, `user_id`) VALUES
(1, 1)');


            DB::statement('CREATE TABLE `advertisers_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');


            DB::statement('INSERT INTO `advertisers_details` (`id`, `user_id`) VALUES
(1, 1)');

            DB::statement('CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `budget` float DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `brand_logo` varchar(100) DEFAULT NULL,
  `advertiser_id` int(11) DEFAULT NULL,
  `proposal_id` int(11) DEFAULT NULL,
  `status` enum(\'active\',\'inactive\') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

            DB::statement('INSERT INTO `campaigns` (`id`, `title`, `description`, `budget`, `start_date`, `end_date`, `created_by`, `updated_by`, `created_at`, `updated_at`, `brand_logo`, `advertiser_id`, `proposal_id`, `status`) VALUES
(2, "vvvvv update.", "Mahesh update", 200, "2022-03-22", "2022-03-30", NULL, NULL, "2022-03-20 13:35:57", "2022-03-20 13:37:43", NULL, 1, 2, "active")');

            DB::statement('CREATE TABLE `campaign_content_mapp` (
  `id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `content_lib_id` int(11) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `status` enum(\'active\',\'inactive\') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

            DB::statement('INSERT INTO `campaign_content_mapp` (`id`, `campaign_id`, `content_lib_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`) VALUES
(0, 2, 2, NULL, NULL, NULL, NULL, "active"),
(1, 2, 2, NULL, NULL, NULL, NULL, "active")');

            DB::statement('CREATE TABLE `campaign_influencers_map` (
  `id` int(11) NOT NULL,
  `influencer_id` int(11) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum(\'active\',\'inactive\') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

            DB::statement('CREATE TABLE `content_library` (
  `id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` varchar(191) NOT NULL,
  `dimension` varchar(191) NOT NULL,
  `mediafile` varchar(191) NOT NULL,
  `media_type` varchar(191) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `company_id` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `status` enum(\'active\',\'inactive\') NOT NULL,
  `advertiser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');


            DB::statement('CREATE TABLE `content_product_mapp` (
  `id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `status` enum(\'active\',\'inactive\') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
            /*
            DB::statement('CREATE TABLE `failed_jobs` (
              `id` bigint(20) UNSIGNED NOT NULL,
              `connection` text  NOT NULL,
              `queue` text  NOT NULL,
              `payload` longtext  NOT NULL,
              `exception` longtext  NOT NULL,
              `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ');
            */
            DB::statement('CREATE TABLE `influencer_product_rates` (
  `id` int(11) NOT NULL,
  `influencer_id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `brand_logo` varchar(45) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

            /*
            DB::statement('CREATE TABLE `migrations` (
              `id` int(10) UNSIGNED NOT NULL,
              `migration` varchar(255)  NOT NULL,
              `batch` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4') ;*/

            /*
            DB::statement('CREATE TABLE `model_has_permissions` (
              `permission_id` bigint(20) UNSIGNED NOT NULL,
              `model_type` varchar(255)  NOT NULL,
              `model_id` bigint(20) UNSIGNED NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4') ;

            DB::statement('CREATE TABLE `model_has_roles` (
              `role_id` bigint(20) UNSIGNED NOT NULL,
              `model_type` varchar(255)  NOT NULL,
              `model_id` bigint(20) UNSIGNED NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ');*/

            /*
          DB::statement('
          INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
          (1, "App\\Models\\User", 5)');*/

            /*
            DB::statement('CREATE TABLE `password_resets` (
              `email` varchar(255)  NOT NULL,
              `token` varchar(255)  NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4') ;*/
            /*
            DB::statement('CREATE TABLE `permissions` (
              `id` bigint(20) UNSIGNED NOT NULL,
              `name` varchar(255)  NOT NULL,
              `guard_name` varchar(255)  NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4') ;*/

            DB::statement('CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `days` int(11) NOT NULL COMMENT "number of days to fulfill",
  `active` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

            DB::statement('
INSERT INTO `product` (`id`, `name`, `description`, `days`, `active`) VALUES
(1, "Customized Video Message", "Downloadable high definition videos from influencers up to 3 minutes long.", 7, 1),
(2, "Facebook Video", "", 7, 1),
(3, "Facebook Live", "Influencer broadcast themselves using brands products or attending an event the brand is sponsoring.", 7, 1),
(4, "Facebook Contest", "Influencer posts photos with products with a call to act on a link to a contest page on the advertiser website.", 7, 1),
(5, "Facebook Cross-Promotion", "Influencer write a blog post about a product or use a food brands ingredient or recipe on their site, then link to that content on their Facebook channel.", 7, 1),
(6, "Instagram Post", "", 7, 1),
(7, "Instagram Story", "Short clip that is viewed on influencer profile. 10 seconds long, only show up for 24 hours.", 7, 1),
(8, "Instagram Reel", "60 seconds long video similar to Tiktok", 7, 1),
(9, "Instagram IGTV", "15 minutes long on mobile / 60 minutes on desktop", 7, 1),
(10, "TikTok 60 sec Video", "", 7, 1),
(11, "TikTok 3 min Video", "", 7, 1),
(13, "TikTok 10 min Video", "", 7, 1)');

            DB::statement('
CREATE TABLE `proposals` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `min_budget` float DEFAULT NULL,
  `max_budget` float DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `advertiser_id` int(11) DEFAULT NULL,
  `status` enum(\'active\',\'inactive\') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
            /*
            DB::statement('
            CREATE TABLE `roles` (
              `id` bigint(20) UNSIGNED NOT NULL,
              `name` varchar(255)  NOT NULL,
              `guard_name` varchar(255)  NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ');*/
            /*
            DB::statement('
            CREATE TABLE `role_has_permissions` (
              `permission_id` bigint(20) UNSIGNED NOT NULL,
              `role_id` bigint(20) UNSIGNED NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4') ;*/

            /*
            DB::statement('
            CREATE TABLE `users` (
              `id` bigint(20) UNSIGNED NOT NULL,
              `email` varchar(255)  NOT NULL,
              `email_verified_at` timestamp NULL DEFAULT NULL,
              `password` varchar(255)  NOT NULL,
              `remember_token` varchar(100)  DEFAULT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              `title` varchar(255)  DEFAULT NULL,
              `firstName` varchar(255)  DEFAULT NULL,
              `lastName` varchar(255)  DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');*/

            DB::statement('
INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `title`, `firstName`, `lastName`) VALUES
(1, "mayuresh.gramopadhye+student@gmail.com", "2022-03-09 02:43:50", "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi", "GpMTuz3FLc", "2022-03-09 02:43:50", "2022-03-09 02:43:50", NULL, NULL, NULL)');

            DB::statement('
ALTER TABLE `addresses`
  ADD KEY `id` (`id`)');
            /*
            DB::statement('
            ALTER TABLE `admins`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `admins_email_unique` (`email`)');*/

            DB::statement('
ALTER TABLE `admin_details`
  ADD KEY `id` (`id`)');

            DB::statement('
ALTER TABLE `advertisers_details`
  ADD KEY `id` (`id`)');

            DB::statement('
ALTER TABLE `campaigns`
  ADD KEY `id` (`id`)');

            DB::statement('
ALTER TABLE `campaign_influencers_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `pro_fk0_idx` (`product_id`),
  ADD KEY `camp_inf_fk_idx` (`campaign_id`),
  ADD KEY `user_id_fk_pro_advid00` (`influencer_id`)');

            DB::statement('
ALTER TABLE `content_library`
  ADD KEY `id` (`id`)');

            DB::statement('
ALTER TABLE `content_product_mapp`
  ADD KEY `id` (`id`)');
            /*
            DB::statement('
            ALTER TABLE `failed_jobs`
              ADD PRIMARY KEY (`id`)');*/

            DB::statement('
ALTER TABLE `influencer_product_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `pro_fk_idx` (`product_id`),
  ADD KEY `user_id_fk_pro_advid0` (`influencer_id`)');

   /*         DB::statement('
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`)');*/
            /*
            DB::statement('
            ALTER TABLE `model_has_permissions`
              ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
              ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)');
                    });
            */
            /*    DB::statement('
        ALTER TABLE `model_has_roles`
          ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
          ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)');*/

     /*       DB::statement('
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`)'); */

            /*        DB::statement('
            ALTER TABLE `permissions`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)');*/

            DB::statement('
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`)');

            DB::statement('
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `user_id_fk_pro_advid_idx` (`advertiser_id`)');

            /*     DB::statement('
         ALTER TABLE `roles`
           ADD PRIMARY KEY (`id`),
           ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)');*/

            /* DB::statement('
     ALTER TABLE `role_has_permissions`
       ADD PRIMARY KEY (`permission_id`,`role_id`),
       ADD KEY `role_has_permissions_role_id_foreign` (`role_id`)');*/

   /*         DB::statement('
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`)');*/

            DB::statement('
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');

            /*    DB::statement('
        ALTER TABLE `admins`
          MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT');*/

            DB::statement('
ALTER TABLE `admin_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2');

            DB::statement('
ALTER TABLE `advertisers_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2');

            DB::statement('
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3');

            DB::statement('
ALTER TABLE `campaign_influencers_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');

            DB::statement('
ALTER TABLE `content_library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3');

            DB::statement('
ALTER TABLE `content_product_mapp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');

            /*    DB::statement('
        ALTER TABLE `failed_jobs`
          MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT');*/

            DB::statement('
ALTER TABLE `influencer_product_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');

            DB::statement('
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9');

            /*  DB::statement('
      ALTER TABLE `permissions`
        MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT'); */

            DB::statement('
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14');

            DB::statement('
ALTER TABLE `proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6');

            /*      DB::statement('
          ALTER TABLE `roles`
            MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2');*/

     /*       DB::statement('
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6');*/

            /*     DB::statement('
         ALTER TABLE `model_has_permissions`
           ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE');
         */
            /*  DB::statement('
      ALTER TABLE `model_has_roles`
        ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE');
      */
            /*  DB::statement('
      ALTER TABLE `role_has_permissions`
        ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
        ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE');
        ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
