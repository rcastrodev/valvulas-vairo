<?php

use App\Content;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Home  */
        Content::create([
            'section_id'=> 1,
            'order'     => 'AA',
            'image'     => 'images/home/Maskgroup.png',
            'content_1' => 'Fabricación de válvulas',
            'content_2' => 'Fabricamos Válvulas de control, Válvulas de seguridad y alivio, Reguladores de presión, Válvulas de corte, Controles de nivel e instrumentación neumática.'
        ]);

        Content::create([
            'section_id'=> 2,
            'image'     => 'images/home/image207.png',
            'content_1' => 'Válvulas vairo',
            'content_2' => '<p><strong>Contamos con más de 60 años de experiencia en el mercado</strong> </p>
            <p>Vairo fue fundada el 10 de febrero de 1997, respaldados por la marca Vairo  con más de 40 años en el mercado argentino, y con el objetivo de continuar con la fabricación de las válvulas y niveles marca Vairo</p>
            <p>Contando además con un departamento técnico con personal especializado para asesorar a empresas, industrias y comercios.</p>',
        ]);
    
        /** Empresa */
        Content::create([
            'section_id'=> 3,
            'image'     => 'images/company/image207.png',
            'content_1' => 'Nosotros',
            'content_2' => '<p>Desde 1958, Valvulas Vairo se ha dedicado a la fabricación de válvulas de control, seguridad y reguladores de presión para una amplia gama de, fluidos, presiones y temperaturas.</p>
            <p>Fundada por Manuel Dolabjian, en la localidad de Quilmes, quien pudo convertir su sueño en un negocio rentable y lo que parecía mas complejo sobrevivir a las crisis y garantizar la continuidad del trabajo de su gente, con el pasar de los años Estudio Técnico Doma S.A. fue evolucionando llegando a estar entre las primeras de su rubro.</p>
            <p>En la búsqueda de satisfacer las inquietudes técnicas y necesidades operativas de sus clientes, por un lado, y llevados por el espíritu de superarse día a día, Valvulas Vairo siguió desarrollando nuevos productos e incorporando nuevas tecnologías.</p>
            <p>En el año 2001 desembarca en Cañadón Seco, Provincia de Santa Cruz como el primer fabricante del rubro en la cuenca del Golfo San Jorge. La situación del petróleo en esos tiempos generaba incertidumbre, estas contingencias permitieron mejor aceptación y agrado de los clientes, logrando convenios locales con las principales operadoras.</p>
            <p>Ese mismo año y anticipando las exigencias de los mercados comienza una etapa de adecuación con las normas de gestión según los lineamientos de las ISO 9001:2000, siendo de las primeras en el rubro en certificar dicha norma. 2004 año donde el mercado ratifico el rumbo gratificando con la adjudicación del contrato corporativo Repsol YPF s.a. Argentina-Bolivia-Brasil, la primera exportación a Pirelli PNS. Brasil y luego de mas de 30 años de relación Estudio Técnico Doma s.a., consolida su vinculo con Pan American Energy siendo beneficiada con un contrato de consignación en el Almacén del Yacimiento Cerro Dragón.</p>',
        ]);

        Content::create([
            'section_id'=> 4,
            'content_1' => '¿Por qué elegirnos?',
        ]);

        Content::create([
            'section_id'=> 5,
            'order'     => 'A1',
            'image'     => 'images/company/Group3714.png',
            'content_1' => 'MisIón',
            'content_2' => '<p>Propuestas de mejoras para elevar el rendimiento del equipo y bajar los tiempos de paradas por rotura, aumentando la  producción.</p>',
        ]);

        Content::create([
            'section_id'=> 5,
            'order'     => 'A2',
            'image'     => 'images/company/Group3716.png',
            'content_1' => 'Visión',
            'content_2' => '<p>Relevamiento (realizando planos de una muestra) de repuestos importados para su nacionalización.</p>',
        ]);

        Content::create([
            'section_id'=> 5,
            'order'     => 'A3',
            'image'     => 'images/company/Group3713.png',
            'content_1' => 'Calidad',
            'content_2' => '<p>Realizamos trabajos de urgencia de ser necesario fines de semana o nocturnos,para su mejor eficiencia en la producción.</p>',
        ]);


        Content::create([
            'section_id'=> 6,
            'image'     => 'images/services/Rectangle4092.png',
            'content_1' => '<ul><li>Todo el asesoramiento y la asistencia técnica necesario para elegir el producto apropiado para vuestra aplicación y su correcta implementación e instalación.</li><li>Diseños acordes a necesidades puntuales y particulares de cada cliente.</li><li>Mecanizado para piezas de gran porte.</li><li>Servicio de prueba hidráulica de válvulas que hayan permanecido mucho tiempo en almacenes ó mal estibadas.</li><li>Trabajos estandar bajo norma</li><li>Trabajos especiales fuera de norma</li></ul>',
        ]);


        Content::create([
            'section_id'=> 7,
            'image'     => 'images/quality/Maskgrouph.png',
            'content_1' => '<p>Válvulas Vairo omenzó a trabajar bajo sistemas de aseguramiento de la calidad. En 1998 se logro certificar el sistema de calidad bajo normas ISO 9000, la certificación fue otorgada por el organismo IRAM.</p>
            <p>En el 2016 Válvulas Vairo  certificó su Sistema de Gestión de la Calidad bajo Normas API Q1 siguiendo su camino de mejora continua y en busca de ofrecerles a sus clientes mejores estándares de calidad día a día.</p>
            <p>En la actualidad realizamos todos nuestros procesos bajo un Sistema de Gestión de la Calidad según Normas ISO 9001-2015 y API Q1, certificado por el Instituto Americano de Petroleo.</p>',
        ]);

        Content::create([
            'section_id'=> 8,
            'order'     => 'AA',
            'image'     => 'images/quality/lq6707SZNl1exksxLEqAX.jpg',
            'content_1' => 'Políticas de calidad',
        ]);

        Content::create([
            'section_id'=> 8,
            'order'     => 'BB',
            'image'     => 'images/quality/lq6707SZNl1exksxLEqAXkL7eyLS.jpg',
            'content_1' => 'Políticas de calidad',
        ]);

        
        Content::create([
            'section_id'=> 9,
            'order'     => 'AA',
            'image'     => 'images/clients/image208.png',
        ]);

        Content::create([
            'section_id'=> 9,
            'order'     => 'AA',
            'image'     => 'images/clients/image209.png',
        ]);

        Content::create([
            'section_id'=> 9,
            'order'     => 'AA',
            'image'     => 'images/clients/image210.png',
        ]);

        Content::create([
            'section_id'=> 9,
            'order'     => 'AA',
            'image'     => 'images/clients/image211.png',
        ]);
    }
}






