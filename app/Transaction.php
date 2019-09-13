<?php

namespace App;

use App\Buyer;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\softDeletes;
use App\Transformers\TransactionTransformer;

class Transaction extends Model
{	

    // use softDeletes;

    public $transformer = TransactionTransformer::class;

    protected $fillable = [
    	'quantity',
    	'buyer_id',
    	'product_id',
    ];

    public function buyer()
    {
    	return $this->belongsTo(Buyer::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}