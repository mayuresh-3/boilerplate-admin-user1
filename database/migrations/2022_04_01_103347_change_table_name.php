<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_product_mapp', function (Blueprint $table) {
            \Illuminate\Support\Facades\Artisan::call('permission:create-role influencer');
            \Illuminate\Support\Facades\Artisan::call('permission:create-role admin');
            \Illuminate\Support\Facades\Artisan::call('permission:create-role advertiser');
        });
        Schema::rename('content_product_mapp', 'campaign_product_mapp');

        \App\Models\User::insert([
            [
                'firstName' => 'Tamayou',
                'lastName' => 'Admin',
                'email' => 'tamayou.admin@tamayou.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
        $user = \App\Models\User::where('email', 'tamayou.admin@tamayou.com')->first();
        $user->assignRole('admin');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_product_mapp', function (Blueprint $table) {
            //
        });
    }
}
