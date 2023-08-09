<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('parrent_id')->default(0); 
            $table->string('icon')->nullable();
            $table->boolean('is_sidebar')->default(0);
            $table->string('title');
            $table->string('url');
            $table->string('method');
            $table->string('slug');
            $table->text('child')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
        Schema::create('permissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });
        Schema::create('role_has_module', function (Blueprint $table) {
            $table->uuid('role_id');
            $table->uuid('module_id');
        });
        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->uuid('permission_id');
            $table->uuid('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('role_has_module');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('modules');
    }
}
