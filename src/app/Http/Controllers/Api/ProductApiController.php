<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        $pembeli = $request->get('authenticated_pembeli');
        return response()->json($pembeli->transaksi()->get());
    }    

}