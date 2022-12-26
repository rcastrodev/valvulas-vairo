<?php

use App\Data;
use App\Company;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Data::create([
            'company_id'=> Company::first()->id,
            'address'   => 'Gervasio A. de Posadas 1034, Lanús. Buenos Aires',
            'email'     => 'info@valvulasvairo.com.ar',
            'phone1'    => '+5401142462438|011 4246-2438',
            'phone3'    => '+5401142462438',
            'instagram' => '#',
            'facebook'  => '#',
            'logo_header'=> 'images/data/Group3741.png',
            'logo_footer'=> 'images/data/Group3741.png',
        ]);
    }
}