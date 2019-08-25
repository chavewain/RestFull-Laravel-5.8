<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()->with('product.categories')
        ->get()
        ->pluck('product.categories') // filtramos la lista de vendedores
        ->collapse(); // genera una sola lista o arreglo unidimensional
        // ->unique('id') // eliminamos la duplicidad
        // ->values(); // reorganizamos los indice y eliminamos los vacios

        // dd($categories);

        return $this->showAll($categories);
    }

    
}
