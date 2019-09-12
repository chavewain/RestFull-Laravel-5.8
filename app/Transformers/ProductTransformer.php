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
            'identificador' => (int)$user->id,
            'titulo' => (string)$user->name,
            'detalles' => (string)$user->description,
            'disponibles' => (int)$user->quantity,
            'estado' => (string)$user->status,
            'imagen' => url('imgs/{$user->image}'),
            'vendedor' => (string)$user->seller_id,
            'esAdministrador' => ($user->admin === true),
            'fechaCreacion' => (string)$user->creted_at,
            'fechaActualizacion' => (string)$user->updated_at,
            'fechaEliminacion' => isset($user->deleted_at) ? (string) $user->deleted_at : null,

        ];
    }
}
