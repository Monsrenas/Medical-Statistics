<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Nomenclature extends Component
{
    use WithPagination;

    protected $lista=[];
    public $xcoder="";
    public $open=false;
    public $postToEdit="", $postIdToDelete, $nameToDelete,$showDeleteModal;
    public $field=[], $modelo="", $columna=[];
    public $name;
    public $rules;
    
    public function render()
    {
        $lista=[];
        if ($this->xcoder) $lista=($this->modelo)::paginate(6);
        return view('livewire.nomenclature', compact('lista'));
    }

    public function new(){
        $this->reset('postToEdit');
        $this->open = true;
    }

    public function save() {
        $vldt=$this->validate(['field.*'=> 'required']);
        
        if (isset($vldt['field'])and (count($vldt['field'])==count($this->columna)-3)){
        
                for ($i = 1; $i <= count($this->field); $i++) {
                    $datos[$this->columna[$i]]=$this->field[$i]; 
                }
                if ($this->postToEdit=="") {
                    $this->postToEdit=($this->modelo)::create($datos);
                }
                    else
                    {
                        $this->postToEdit->fill($datos);
                        $this->postToEdit->save();

                    }

            $this->open = false;
            $this->reset('postToEdit','field');
        }
    }

    public function edit($postId){
        $this->postToEdit = ($this->modelo)::find($postId);
        $this->field=[];
        if ($this->postToEdit) {
            for ($i = 1; $i <= count($this->columna)-3; $i++) {
               $this->field[$i]=$this->postToEdit[$this->columna[$i]];
            }
 
        }
       
        $this->open = true; 

    }

    public function updatedXcoder(){
        $this->modelo="App\Models\\".$this->xcoder;
        if ($this->xcoder) {
            $modelo = new ($this->modelo);    
            $this->columna = $modelo->getConnection()->getSchemaBuilder()->getColumnListing($modelo->getTable());   
        }
        $this->resetPage();
    }

    public function confirmDelete($postId){
        $this->postIdToDelete = $postId;
        $this->nameToDelete= ($this->modelo)::find($this->postIdToDelete)->name;
        $this->showDeleteModal = true;
    }

    public function deletePost(){
        if ($this->postIdToDelete) {
            $post = ($this->modelo)::find($this->postIdToDelete);
            if ($post) {
                $post->delete();
            }
        }

        $this->reset('postIdToDelete','nameToDelete');
        $this->showDeleteModal = false;
    }

    public function updatedOpen(){
        if ($this->open==false) {
            $this->reset('postToEdit','field');
        }
        $this->resetPage();
    }

}
