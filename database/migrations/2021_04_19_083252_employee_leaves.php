<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeeLeaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->float('days');
            $table->datetime('leave_from');
            $table->datetime('leave_to');
            $table->timestamps();
            $table->datetime('has_approved')->nullable();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}