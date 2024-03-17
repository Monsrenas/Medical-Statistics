<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Nomenclature extends Component
{

    public $xcoder="";
    public $open=false;
    public $postToEdit="";

    public function render()
    {

        return view('livewire.nomenclature');
    }

    public function new(){
        $this->reset('postToEdit');
        $this->open = true;
    }

}
