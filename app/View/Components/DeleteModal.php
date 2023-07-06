<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteModal extends Component
{
    public $table;
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($table,$id)
    {
        $this->table = $table;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delete-model');
    }
}
