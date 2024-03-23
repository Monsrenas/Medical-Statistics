<?php
namespace App\Traits;
use Illuminate\Support\Carbon;

trait Tools {

    public $centerLs=[], $informLs=[];
    public $xcenter, $xinform, $meses;
    public $xFrom,$xTo;
    
    
    public function mount()
    {
        $this->xyear=date('Y');
        // Fecha de hoy
        $this->xTo = now()->format('Y-m-d');

        // Fecha 4 años antes del 1 de enero
        $this->xFrom = now()->subYears(4)->startOfYear()->format('Y-m-d');

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