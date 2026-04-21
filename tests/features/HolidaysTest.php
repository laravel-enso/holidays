<?php

require_once __DIR__.'/../../src/Models/HolidayYear.php';
require_once __DIR__.'/../../src/Models/Holiday.php';
require_once __DIR__.'/../../src/Http/Resources/Year.php';
require_once __DIR__.'/../../src/Http/Resources/Holiday.php';
require_once __DIR__.'/../../src/Http/Controllers/Index.php';
require_once __DIR__.'/../../src/Http/Controllers/Show.php';
require_once __DIR__.'/../../src/Http/Controllers/Toggle.php';

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Holidays\Http\Controllers\Index;
use LaravelEnso\Holidays\Http\Controllers\Show;
use LaravelEnso\Holidays\Http\Controllers\Toggle;
use LaravelEnso\Holidays\Models\Holiday;
use LaravelEnso\Holidays\Models\HolidayYear;
use LaravelEnso\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HolidaysTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed()
            ->actingAs(User::first());

        $this->createTables();
        $this->registerRoutes();
    }

    #[Test]
    public function can_list_available_years(): void
    {
        $firstYear = HolidayYear::create(['year' => 2025]);
        $secondYear = HolidayYear::create(['year' => 2026]);

        $this->get('/_test/holidays')
            ->assertStatus(200)
            ->assertJsonFragment(['id' => $firstYear->id, 'name' => 2025])
            ->assertJsonFragment(['id' => $secondYear->id, 'name' => 2026]);
    }

    #[Test]
    public function can_show_holidays_for_a_year_sorted_by_date(): void
    {
        $year = HolidayYear::create(['year' => 2026]);

        $lateHoliday = Holiday::create([
            'year_id' => $year->id,
            'date' => '2026-12-25',
            'name' => 'Christmas',
            'description' => 'Holiday',
            'is_working_day' => false,
        ]);

        $earlyHoliday = Holiday::create([
            'year_id' => $year->id,
            'date' => '2026-01-01',
            'name' => 'New Year',
            'description' => 'Holiday',
            'is_working_day' => false,
        ]);

        $response = $this->get("/_test/holidays/{$year->id}")
            ->assertStatus(200)
            ->assertJsonStructure(['holidays', 'months']);

        $months = collect($response->json('months'));
        $content = $response->getContent();

        $response->assertJsonFragment(['id' => $earlyHoliday->id, 'name' => 'New Year'])
            ->assertJsonFragment(['id' => $lateHoliday->id, 'name' => 'Christmas']);

        $this->assertLessThan(
            strpos($content, "\"id\":{$lateHoliday->id}"),
            strpos($content, "\"id\":{$earlyHoliday->id}")
        );
        $this->assertCount(12, $months);
        $this->assertNotNull($months->firstWhere('id', 1));
        $this->assertNotNull($months->firstWhere('id', 12));
    }

    #[Test]
    public function can_toggle_a_holiday_working_day_flag(): void
    {
        $year = HolidayYear::create(['year' => 2026]);
        $holiday = Holiday::create([
            'year_id' => $year->id,
            'date' => '2026-05-01',
            'name' => 'Labour Day',
            'description' => null,
            'is_working_day' => false,
        ]);

        $this->patch("/_test/holidays/{$holiday->id}/toggle")
            ->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertTrue($holiday->fresh()->is_working_day);
    }

    private function createTables(): void
    {
        Schema::create('holiday_years', function ($table) {
            $table->increments('id');
            $table->unsignedSmallInteger('year');
            $table->timestamps();
        });

        Schema::create('holidays', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('year_id');
            $table->date('date');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('is_working_day')->default(false);
            $table->timestamps();
        });
    }

    private function registerRoutes(): void
    {
        if (Route::has('holidays.index')) {
            return;
        }

        Route::middleware('bindings')->group(function () {
            Route::get('/_test/holidays', Index::class)->name('holidays.index');
            Route::get('/_test/holidays/{year}', Show::class)->name('holidays.show');
            Route::patch('/_test/holidays/{holiday}/toggle', Toggle::class)->name('holidays.toggle');
        });
    }
}
