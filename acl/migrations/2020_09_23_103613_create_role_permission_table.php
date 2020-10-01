<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permission', function (Blueprint $table) {
             $table->unsignedInteger('role_id');
             $table->unsignedInteger('permission_id');

             //FOREIGN KEY CONSTRAINTS
             $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
             $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

             //SETTING THE PRIMARY KEYS
             $table->primary(['role_id','permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permission');
    }
}
