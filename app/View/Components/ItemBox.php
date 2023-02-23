<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ItemBox extends Component
{
    public $title;
    public $image;
    public $details;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$details = null , $image = null)
    {
        $this->title = $title;
        $this->details = $details;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item-box');
    }
}
