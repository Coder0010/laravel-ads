<?php

namespace MKamelMasoud\CoreConfig\Database\Seeders;

use DB;
use Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ResetDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableNames = array_column(DB::select('SHOW TABLES'), 'Tables_in_' . env('DB_DATABASE'));

        Schema::disableForeignKeyConstraints();
        foreach ($tableNames as $name) {
            if ($name == 'migrations' || Str::startsWith($name, 'oauth')) {
                continue;
            }
            DB::table($name)->truncate();
        }
        Schema::enableForeignKeyConstraints();
    }

}
