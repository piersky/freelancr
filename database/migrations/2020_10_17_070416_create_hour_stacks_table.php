<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHourStacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hour_stacks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('qty')->default(0);
            $table->decimal('price', 5, 2, true)->default(0.0);
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->on('customers')->references('id');
            $table->timestamps();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_prepayed')->default(0);
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->on('users')->references('id');
            $table->bigInteger('updated_by')->unsigned();
            $table->foreign('updated_by')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hour_stacks');
    }
}
