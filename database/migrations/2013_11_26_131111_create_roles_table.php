<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role')->unique();

            // Article permissions
            $table->boolean('writer')->default(false); // can create their own articles and manage them
            $table->boolean('edit_article')->default(false); // can edit any article
            $table->boolean('delete_article')->default(false); // can delete any article

            // Role permissions
            $table->boolean('create_role')->default(false);
            $table->boolean('edit_role')->default(false);
            $table->boolean('delete_role')->default(false);

            // User permissions
            $table->boolean('create_user')->default(false); // can create users (only admin?)
            $table->boolean('edit_user')->default(false); // can edit any user
            $table->boolean('delete_user')->default(false); // can delete any user

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
