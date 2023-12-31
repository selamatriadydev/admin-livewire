<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) { // Foreign key constraint
            $table->uuid('role_id')->nullable()->after('password'); // Foreign key for role
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onDelete('set null');
            $table->string('status_active')->nullable()->after('role_id');
            $table->timestamp('last_seen_at')->nullable()->after('role_id');
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
            $table->dropColumn('role_id');
            $table->dropColumn('status_active');
            $table->dropColumn('last_seen_at');
        });
    }
}
