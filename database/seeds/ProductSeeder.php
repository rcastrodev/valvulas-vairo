<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id'   => 1,        
            'order'         => 'A1',
            'name'          => 'Adoquín circular chico',
            'description'   => '<h6>Características del material:</h6>
            <p>Nuestros moldes son livianos, flexibles y tienen buena resistencia al impacto. Son aptos para uso tanto con hormigón como con yeso.</p><h6>Medidas:</h6><ul><li>Ancho: 40 cm</li><li>Largo: 40 cm</li><li>Alto: 2,5 cm</li></ul>'
        ]);
    }
}






