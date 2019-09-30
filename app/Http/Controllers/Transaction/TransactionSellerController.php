<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TransactionSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Collection $collection,Transaction $transaction)
    {

        // dd($transaction);
        $seller = $transaction->product->seller;


        return $this->showOne($seller);
    }

  
}
