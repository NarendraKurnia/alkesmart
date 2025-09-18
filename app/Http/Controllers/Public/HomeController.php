<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Banner_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $banner = Banner_Model::all();
        return view('index', [ 
            'title' => 'Alkesmart',
            'banner'  => $banner,
        ]);
    }
}
