<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Nomenclature extends Component
{
    use WithPagination;

    public $xcoder="";
    public $open=false;
    public $postToEdit="";
    public $field=[], $modelo="", $columna="";

    public function render()
    {
        return view('livewire.nomenclature');
    }

    public function new(){
        $this->reset('postToEdit');
        $this->open = true;
    }

    public function save() {

            
        if ($this->postToEdit=="") {
            $this->postToEdit=($this->modelo);
           
          
            
       }

       $this->open = false;
       for ($i = 1; $i <= count($this->field); $i++) {
        
        $this->postToEdit[$this->columna[$i]]=$this->field[$i]; 
       }
       
       $this->postToEdit->save();

       $this->reset('postToEdit');
            
        
    }

    public function updatedXcoder(){
        $modelo="App\Models\\".$this->xcoder;
        if ($this->xcoder) {
            $this->modelo = new ($modelo);    
            $this->columna = $this->modelo->getConnection()->getSchemaBuilder()->getColumnListing($this->modelo->getTable());   
        }
        
        $this->resetPage();
    }

}
