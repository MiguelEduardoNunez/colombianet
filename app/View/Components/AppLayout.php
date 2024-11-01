<?php

namespace App\View\Components;

use App\Models\Modulo;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public function modulos()
    {
        $modulos = Modulo::permisos(null, Auth::user()->id_usuario);

        return $modulos;
    }
    
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
