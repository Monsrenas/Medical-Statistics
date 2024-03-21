<?php
namespace App\Traits;
use Illuminate\Support\Carbon;

trait Tools {

    public $centerLs=[], $informLs=[];
    protected $montLs=[];
    public $xcenter, $xinform, $meses;
    public function mount()
    {
        $centerLs=('App\Models\\centers')::all();
        $informLs=('App\Models\\information_type')::all();
        foreach ($centerLs as $key => $value) {
            $this->centerLs[$value->id]=$value->name;
        }

        foreach ($informLs as $key => $value) {
            $this->informLs[$value->id]=$value->name;
        }

    }
}