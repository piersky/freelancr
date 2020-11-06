<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjectCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [
            'PHP',
            'FLUTTER',
            'KOTLIN',
            'SWIFT',
            'ANDROID',
            'iOS',
            'LINUX',
            'WINDOWS',
            'WORDPRESS',
            'PRESTASHOP',
            'LARAVEL',
            'JAVASCRIPT / jQuery',
            'CSS / HTML',
            'ICT'];

        foreach ($cats as $cat) {

        }
    }
}
