<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductController
{
    protected $data = [
        'name' => '',
        'amount' => 0,
        'price' => 0,
        'total_price' => '',
    ];
    public function store(Request $request) {
        $this->data = [
            'name' => $request->get('name') ?? '',
            'amount' => $request->get('amount') ?? 0,
            'price' => $request->get('price') ?? 0,
            'total_price' => $request->get('price') ?? '',
        ];

        $this->data = array_merge($this->data, [
            'total_price' => $this->data['amount'] * $this->data['price']
        ]);
        return [
            'status' => 200,
            'message' => 'Success',
            'data' => $this->data
        ];
    }
}
