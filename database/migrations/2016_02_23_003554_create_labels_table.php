<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('contact_label', function (Blueprint $table) {
            $table->char('contact_id', 11);
            $table->char('label_id', 11);
            $table->primary(['contact_id', 'label_id']);
            $table->timestamps();
        });
        Schema::create('contact_user', function (Blueprint $table) {
            $table->char('contact_id', 11);
            $table->char('user_id', 11);
            $table->primary(['contact_id', 'user_id']);
            $table->timestamps();
        });
        Schema::create('label_user', function (Blueprint $table) {
            $table->char('label_id', 11);
            $table->char('user_id', 11);
            $table->primary(['label_id', 'user_id']);
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
        Schema::drop('label_user');
        Schema::drop('contact_label');
        Schema::drop('contact_user');
        Schema::drop('labels');
    }
}
