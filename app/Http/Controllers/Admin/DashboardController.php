<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller{
    
    function dashboard(){
        return response()->json([
            "success" => true,
            "data" => []
        ]);
    }
}
