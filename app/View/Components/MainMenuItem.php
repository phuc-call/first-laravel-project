<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class MainMenuItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $item=null;
    public function __construct($menurow)
    {
        $this->item=$menurow;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    { 
        $menu=$this->item;
        $args = [
            ['status','=',1],
            ['position','=','mainmenu'],
            ['parent_id','=',$menu->id],
        ];
        $menu_list=Menu::select('id','name','link')
        ->where($args)
        ->orderBy('sort_order','asc')
        ->get();
        return view('components.main-menu-item',compact('menu','menu_list'));
    }
}