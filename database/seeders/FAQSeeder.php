<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faqs')->insert([
            'question' => 'Where can I use your products',
            'answer' => 'Please press this link www.google.com for more details on our web application!',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
