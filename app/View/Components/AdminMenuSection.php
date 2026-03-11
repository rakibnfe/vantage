<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminMenuSection extends Component
{
    public $label;

    public function __construct($label)
    {
        $this->label = $label;
    }

    public function render()
    {
        return view('components.admin-menu-section');
    }
}