<?php

use LaravelEnso\Migrator\Database\Migration;

return new class extends Migration {
    protected array $permissions = [
        ['name' => 'holidays.index', 'description' => 'Show index for holiday years', 'is_default' => false],
        ['name' => 'holidays.show', 'description' => 'Show holiday year', 'is_default' => false],
        ['name' => 'holidays.toggle', 'description' => 'Toggle holiday as working day', 'is_default' => false],
    ];

    protected array $menu = [
        'name' => 'Holidays', 'icon' => 'store-slash', 'route' => 'holidays.index', 'order_index' => 999, 'has_children' => false,
    ];
};
