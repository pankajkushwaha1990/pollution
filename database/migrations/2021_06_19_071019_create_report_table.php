<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('industry_id');
            $table->string('duration');
            $table->string('fee_type');
            $table->string('applied_on');
            $table->string('total_fee');
            $table->string('deposited_fee');
            $table->string('deposited_date');
            $table->string('final_fee');
            $table->string('current_ca');
            $table->string('response_date');
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
        Schema::dropIfExists('report');
    }
}
