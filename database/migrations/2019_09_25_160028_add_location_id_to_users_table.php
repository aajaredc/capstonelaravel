<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          // The location ID defaults to the location id of whoever made the user,
          // but it needs to default to 1 in the database because we can't use
          // Auth::user() in the migration
          $table->unsignedBigInteger('location_id')
            ->after('user_type_id')
            ->default(1);
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
          $table->dropColumn('location_id');
        });
    }
}
