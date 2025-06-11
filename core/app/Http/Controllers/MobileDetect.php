<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Detection\MobileDetect;

class ExampleController extends Controller
{
    public function index()
    {
        $detect = new MobileDetect;

        // Verifica se é um dispositivo móvel
        if ($detect->isMobile()) {
            // Conteúdo para dispositivos móveis
            return view('mobile-view'); // substitua pelo nome da sua view para mobile
        } else {
            // Conteúdo para desktop
            return view('desktop-view'); // substitua pelo nome da sua view para desktop
        }
    }
}
