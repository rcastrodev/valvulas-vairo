<?php

namespace App\Http\Controllers;

use App\Page;
use App\Image;
use App\Content;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class QualityController extends Controller
{
    protected $page;

    public function __construct(){
        $this->page = Page::where('name', 'calidad')->first();
    }

    public function content()
    {
        $section1 = Content::where('section_id', 7)->first();
        return view('administrator.quality.content', compact('section1'));
    }
    
    public function storeSlider(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/quality','public');
        

        Content::create($data);
        return back()->with('mensaje', 'Creado con exito');
    }

    public function updateSlider(Request $request)
    {
        $data       = $request->all();
        $element    = Content::find($request->input('id'));

        if($request->hasFile('image')){

            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/quality','public');
        } 

        $element->update($data);

        return back()->with('mensaje', 'Actualizado con exito');
    }

    public function updateInfo(Request $request)
    {
        $element= Content::find($request->input('id'));
        $data   = $request->all();

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/quality','public');
        } 

        $element->update($data);

        return back()->with('mensaje', 'Actualizado con exito');
    }


    public function destroySlider($id)
    {
        $element = Content::find($id);
        if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);
        
        $element->delete();
        return response()->json([], 200);
    }

    public function sliderGetList()
    {
        $sectionSlider = $this->page->sections()->where('name', 'section_2')->first();
        $sliders = $sectionSlider->contents()->orderBy('order', 'ASC');

        return DataTables::of($sliders)
        ->editColumn('image', function($slider){
            return '<img src="'.asset($slider->image).'" class="img-fluid" style="max-width:100px">';
        })
        ->addColumn('actions', function($slider) {
            return '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-element" onclick="findContent('.$slider->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy('.$slider->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'content_1', 'image', 'content_2'])
        ->make(true);
    }

    public function images($id)
    {
        $elements = Content::find($id)->images()->where('name', 'image')->orderBy('order', 'ASC');
        return DataTables::of($elements)
        ->editColumn('image', function($element) {
            return '<img src="'.asset($element->image).'" width="150" height="160">';
        })
        ->addColumn('actions', function($element) {
            return '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-image" onclick="findContentImage('.$element->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalImageDestroy('.$element->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'image'])
        ->make(true);
    }

    public function imagesStore(Request $request)
    {
        $element   = Content::find($request->input('content_id'));
        $data       = $request->all();

        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/services/images','public');
        
        unset($data['content_id']);
        $element->images()->create($data);
        return response()->json([], 201);
    }

    public function imagesUpdate(Request $request)
    {
        $element = Image::find($request->input('id'));
        $data    = $request->all();

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/services/images','public');
        }   
        
        $element->update($data);
        return response()->json([], 200);
    }

    public function findImage($id)
    {
        $image = Image::find($id);
        return response()->json(['content' => $image]);
    }

    public function imageDestroy($id)
    {
        $element = Image::find($id);
        if ($element) {
            if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);

            $element->delete();
        }
        

        return response()->json([], 200);
    }
}
