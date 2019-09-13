<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'identificador' => (int)$product->id,
            'titulo' => (string)$product->name,
            'detalles' => (string)$product->description,
            'disponibles' => (int)$product->quantity,
            'estado' => (string)$product->status,
            'imagen' => url('imgs/{$product->image}'),
            'vendedor' => (string)$product->seller_id,
            'esAdministrador' => ($product->admin === true),
            'fechaCreacion' => (string)$product->creted_at,
            'fechaActualizacion' => (string)$product->updated_at,
            'fechaEliminacion' => isset($product->deleted_at) ? (string) $product->deleted_at : null,

        ];
    }

    public static function originalAttributes($index)
    {
        $attributes = [
            'identificador' => 'id',
            'titulo' => 'name',
            'detalles' => 'description',
            'disponibles' => 'quantity',
            'estado' => 'status',
            'imagen' => 'image',
            'vendedor' => 'seller_id',
            'esAdministrador' => 'admin',
            'fechaCreacion' => 'creted_at',
            'fechaActualizacion' => 'updated_at',
            'fechaEliminacion' => 'deleted_at',   
        ];

        return (isset($attributes[$index])) ? $attributes[$index] : null;
    }
}
