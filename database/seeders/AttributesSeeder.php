<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handle = fopen(storage_path('app/data/attributes.csv'), 'r');

        $ignoreHeader = fgetcsv($handle);

        while ($row = fgetcsv($handle)) {
            Attribute::create([
                'id' => $row[0],
                'name' => $row[1],
            ]);
        }

        fclose($handle);
    }
}
