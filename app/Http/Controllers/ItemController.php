<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Item());
        $this->middleware('auth');
    }
    protected function validationRule()
    {
        return [
            'name' =>'required|max:255',
            'description' =>'required',
            'price' =>'required|numeric',
            'quantity' =>'required|numeric',
            'category_id' =>'required|numeric',
        ];
    }
}
