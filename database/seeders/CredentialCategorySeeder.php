<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CredentialCategorySeeder extends Seeder
{
    private $cats_en = [
        'Backend / Admin',
        'Database',
        'Account FTP',
        'Email',
        'SSH',
        'PC user login',
        'Web service'
    ];

    private $cats_it = [
        'Pannello di amministrazione',
        'Database',
        'Account FTP',
        'Casella email',
        'SSH',
        'Login utente PC',
        'Servizio web'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->cats_en as $cat) {
            DB::table('credential_categories')->insert([
                'name' => $cat,
                'lang_id' => 'en',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now()
            ]);
        }

        foreach($this->cats_it as $cat) {
            DB::table('credential_categories')->insert([
                'name' => $cat,
                'lang_id' => 'it',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
