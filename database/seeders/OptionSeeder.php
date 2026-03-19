<?php

namespace Database\Seeders;

use App\Modules\Options\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    public function run(): void
    {
        Option::updateOrCreate(
            ['key' => 'onboarding'],
            ['value' => 'true']
        );
    }
}
