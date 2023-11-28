<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Rumahsakit;
use Illuminate\Http\Request;

class MainMenuController extends Controller
{
    public function index(){
        $totalRumahsakit = Rumahsakit::count();
        $totalPasien = Pasien::count();
        return view("main.index", compact("totalRumahsakit", "totalPasien"));
    }

}
