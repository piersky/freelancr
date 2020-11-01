<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->on('projects')->references('id');
            $table->timestamp('start_at')->useCurrent()->nullable();
            $table->timestamp('stop_at')->nullable();
            $table->bigInteger('hourstack_id')->unsigned();
            $table->foreign('hourstack_id')->on('hour_stacks')->references('id');
            $table->bigInteger('assigned_to')->unsigned();
            $table->foreign('assigned_to')->on('users')->references('id');
            $table->decimal('used_hours', 3, 1)->nullable()->default(0.0);
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
        Schema::dropIfExists('activities');
    }
}
