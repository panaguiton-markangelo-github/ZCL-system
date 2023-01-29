<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class CLibrarianLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('catalog_librarian.layouts.app');
    }
}
