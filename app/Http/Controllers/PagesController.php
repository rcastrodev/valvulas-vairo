<?php

namespace App\Http\Controllers;

use SEO;
use App\Data;
use App\Page;
use App\Content;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PagesController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data = Data::first();
    }

    public function home()
    {
        $page = Page::where('name', 'home')->first();
        SEO::setTitle('home');
        SEO::setDescription(strip_tags($this->data->description)); 
        $sections   = $page->sections;
        $sliders    = Content::where('section_id', 1)->orderBy('order', 'ASC')->get();
        $categories = Category::orderBy('order', 'ASC')->where('outstanding', '1')->get();
        $section2   = Content::where('section_id', 2)->first();
        $clientes   = Content::where('section_id', 9)->orderBy('order', 'ASC')->get();
        return view('paginas.index', compact('sliders', 'categories', 'section2', 'clientes'));
    }

    public function empresa()
    {
        SEO::setTitle('empresa');
        SEO::setDescription(strip_tags($this->data->description));
        $section1  = Content::where('section_id', 3)->first();
        $section2 = Content::where('section_id', 4)->first();
        $sections3 = Content::where('section_id', 5)->orderBy('order', 'ASC')->get();
        return view('paginas.empresa', compact('section1', 'section2', 'sections3'));
    }

    public function categorias()
    {
        $categories = Category::orderBy('order', 'ASC')->get();
        return view('paginas.categorias', compact('categories'));
    }

    public function categoria($id)
    {
        SEO::setTitle('categorías');
        SEO::setDescription(strip_tags($this->data->description)); 
        $categoria = Category::findOrFail($id);
        $categorias = Category::orderBy('order', 'ASC')->get();
        $productos = $categoria->products()->orderBy('order', 'ASC')->get();
        return view('paginas.categoria', compact('productos', 'categorias', 'categoria'));
    }

    public function producto($id)
    {
        $categorias = Category::orderBy('order', 'ASC')->get();
        $producto = Product::findOrFail($id);
        SEO::setTitle($producto->name);
        SEO::setDescription(strip_tags($producto->description)); 
        return view('paginas.producto', compact('producto', 'categorias'));
    }

    public function servicios()
    {
        SEO::setTitle('servicios');
        SEO::setDescription(strip_tags($this->data->description)); 
        $section1 = Content::where('section_id', 6)->first();
        return view('paginas.servicios', compact('section1'));
    }

    public function calidad()
    {
        SEO::setTitle('calidad');
        SEO::setDescription(strip_tags($this->data->description)); 
        $calidad = Content::where('section_id', 7)->first();
        $descargables = Content::where('section_id', 8)->orderBy('order', 'ASC')->get();
        return view('paginas.calidad', compact('calidad', 'descargables'));
    }

    public function clientes()
    {
        SEO::setTitle('clientes');
        SEO::setDescription(strip_tags($this->data->description)); 
        $clientes = Content::where('section_id', 9)->orderBy('order', 'ASC')->get();
        $sector = Content::where('section_id', 10)->first();
        return view('paginas.clientes', compact('clientes', 'sector'));
    }

    public function contacto()
    {
        $content = Content::where('section_id', 9)->where('content_1', 'Contacto')->first();
        $page = Page::where('name', 'contacto')->first();
        SEO::setTitle("contacto");
        return view('paginas.contacto', compact('content'));
    }

    public function descargarArchivo($id, $reg)
    {
        $content = Content::findOrFail($id);  
        if (Storage::disk('public')->exists($content->$reg)) {
            return Response::download($content->$reg);  
        }else{
            return back();  
        }
        
    }

}
