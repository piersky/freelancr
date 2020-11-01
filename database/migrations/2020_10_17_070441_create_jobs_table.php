<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->bigInteger('belongs_to_id')->unsigned();
            $table->foreign('belongs_to_id')->on('users')->references('id');
            $table->timestamp('deadline');
            $table->boolean('is_done')->default(0);
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->on('customers')->references('id');
            $table->timestamps();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('jobs');
    }
}
