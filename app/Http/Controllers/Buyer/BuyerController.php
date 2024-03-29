<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;


class BuyerController extends ApiController
{

    function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // nos referimos a la relacion "transactions" definida en el modelo, 
        // para traer unicamente los usuarios que tengan transacciones.

        $compradores = Buyer::has('transactions')->get(); 

        return $this->showAll($compradores);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {

        return $this->showOne($buyer);
    }
}
