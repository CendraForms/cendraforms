<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RoleUser', function (Blueprint $table) {
        $table->integer('user_id')
            ->index()
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

        $table->integer('role_id')
            ->index()
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
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
        Schema::drop('RoleUser');
    }
};
