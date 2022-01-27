<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositories', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('owner_id');
            $table->string('node_id')->nullable();
            $table->string('name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('url')->nullable();
            $table->integer('forks')->default(0);
            $table->integer('stars')->default(0);
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('pushed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repositories');
    }
}
