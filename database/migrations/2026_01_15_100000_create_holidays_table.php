<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Holidays\Models\HolidayYear;

return new class extends Migration {
    public function up()
    {
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(HolidayYear::class, 'year_id')->constrained();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('date');
            $table->boolean('is_working_day');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('holidays');
    }
};
