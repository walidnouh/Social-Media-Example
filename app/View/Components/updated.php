<?php

namespace App\View\Components;

use Illuminate\View\Component;

class updated extends Component
{
    public $name;

    public $date;

    public $userId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($date,$name=null,$userId=null)
    {
        $this->name=$name;
        $this->date=$date;
        $this->userId=$userId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.updated');
    }
}
