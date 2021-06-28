<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function index()
    {
        $items = Qr::all();

        return view('qrcode.index')->with([
            'items' => $items
            
        ]);
    }
}
