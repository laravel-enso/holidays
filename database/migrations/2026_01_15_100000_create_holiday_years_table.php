<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('holiday_years', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('year');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('holiday_years');
    }
};
