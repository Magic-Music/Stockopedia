<?php

namespace Database\Seeders;

use App\Models\Security;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecuritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handle = fopen(storage_path('app/data/securities.csv'), 'r');

        $ignoreHeader = fgetcsv($handle);

        while ($row = fgetcsv($handle)) {
            Security::create([
                'id' => $row[0],
                'symbol' => $row[1],
            ]);
        }

        fclose($handle);
    }
}
