<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeadlineCategorySeeder extends Seeder
{
    private $cats_en = [
        'Domain',
        'SSL certificate',
        'Web service',
        'Email',
        'Contract',
        'Payment',
        'Taking'
    ];

    private $cats_it = [
        'Dominio',
        'Certificato SSL',
        'Servizio Web',
        'Casella email',
        'Contratto',
        'Pagamento',
        'Incasso'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->cats_en as $cat) {
            DB::table('deadline_categories')->insert([
                'name' => $cat,
                'lang_id' => 'en',
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'updated_at' => Carbon::now()
            ]);
        }

        foreach($this->cats_it as $cat) {
            DB::table('deadline_categories')->insert([
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
