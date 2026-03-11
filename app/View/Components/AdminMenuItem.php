<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Helpers\AdminMenuHelper;

class AdminMenuItem extends Component
{
    public $item;
    public $isActive;
    public $iconComponent;
    public $pendingCount;
    public $pendingColor;

    public function __construct($item)
    {
        $this->item = $item;
        $this->isActive = AdminMenuHelper::isActive($item['pattern'] ?? '');
        $this->iconComponent = AdminMenuHelper::getIconComponent($item['icon'] ?? '');
        $this->pendingCount = $item['pending'] ?? 0;
        $this->pendingColor = $item['pending_color'] ?? 'yellow';
    }

    public function render()
    {
        return view('components.admin-menu-item');
    }
}