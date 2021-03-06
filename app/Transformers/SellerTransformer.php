<?php

namespace App\Transformers;

use App\Seller;
use App\Traits\TransformerAttribute;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
{
    use TransformerAttribute;

    protected static $attributes = [
        'identifier'   => 'id',
        'name'         => 'name',
        'email'        => 'email',
        'isVerified'   => 'verified',
        'creationDate' => 'created_at',
        'lastChange'   => 'updated_at',
        'deleteDate'   => 'deleted_at'
    ];

    /**
     * A Fractal transformer.
     *
     * @param Seller $seller
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
            'identifier'   => (int)$seller->id,
            'name'         => (string)$seller->name,
            'email'        => (string)$seller->email,
            'isVerified'   => (int)$seller->verified,
            'creationDate' => (string)$seller->created_at,
            'lastChange'   => (string)$seller->updated_at,
            'deleteDate'   => isset($seller->deleted_at) ? (string)$seller->deleted_at : null,

            'links' => [
                [
                    'rel'  => 'self',
                    'href' => route('sellers.show', $seller->id),
                ],
                [
                    'rel'  => 'seller.buyers',
                    'href' => route('sellers.buyers.index', $seller->id),
                ],
                [
                    'rel'  => 'seller.categories',
                    'href' => route('sellers.categories.index', $seller->id),
                ],
                [
                    'rel'  => 'seller.products',
                    'href' => route('sellers.products.index', $seller->id),
                ],
                [
                    'rel'  => 'seller.transactions',
                    'href' => route('sellers.transactions.index', $seller->id),
                ],
                [
                    'rel'  => 'user',
                    'href' => route('users.show', $seller->id),
                ],
            ],
        ];
    }
}
