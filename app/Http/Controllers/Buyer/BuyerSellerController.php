<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class BuyerSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()->with('product.seller')
        ->get()
        ->pluck('product.seller') // filtramos la lista de vendedores
        ->unique('id') // eliminamos la duplicidad
        ->values(); // reorganizamos los indice y eliminamos los vacios

        // dd($sellers);

        return $this->showAll($sellers);
    }

 
}
