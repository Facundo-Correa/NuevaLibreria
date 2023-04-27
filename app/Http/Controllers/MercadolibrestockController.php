<?php

namespace App\Http\Controllers;
use\App\Mercadolibrestock;
use Illuminate\Http\Request;

class MercadolibrestockController extends Controller
{
    public function getStock(){
        return Mercadolibrestock::all();
    }

    public function store($request){
        Mercadolibrestock::create([
            'status'=>$request->status,
            'item_id'=>$request->order_items[0]->item->id,
            'fecha'=>$request->date_created,
        ]);
    }

    public function update($request){
        
        $update = Mercadolibrestock::findOrFail($request->order_items[0]->item->id);

    }
}
