<?php

namespace Database\Seeders;

use App\Models\Fact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handle = fopen(storage_path('app/data/facts.csv'), 'r');

        $ignoreHeader = fgetcsv($handle);

        while ($row = fgetcsv($handle)) {
            Fact::create([
                'security_id' => $row[0],
                'attribute_id' => $row[1],
                'value' => $row[2],
            ]);
        }

        fclose($handle);
    }
}
