<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('application_id')->index();
            $table->string('uid', 128)->index();
            $table->string('language', 64);
            $table->enum('operation_system', ['android', 'ios', 'harmonyos', 'other']);
            $table->string('client_token', 128)->unique();
            $table->timestamps();

            $table->unique(['application_id', 'uid']);

            // foreign keys
            $table->foreign('application_id')->references('id')->on('applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
