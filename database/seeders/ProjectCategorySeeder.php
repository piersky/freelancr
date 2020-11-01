<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$sql = 'insert into project_category (name, created_by, updated_by) values (?, ?, ?)';
        //DB::insert($sql, ['PHP', 1, 1]);

        DB::table('project_categories')->insert([
            ['name' => 'PHP', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Flutter', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Wordpress', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Presatshop', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Laravel', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Swift', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Kotlin', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Android', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'iOS', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Javascript / jQuery', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'CSS / HTML', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'ICT', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'App', 'created_by' => 1, 'updated_by' => 1],
        ]);
    }
}
