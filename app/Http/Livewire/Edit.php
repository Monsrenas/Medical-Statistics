<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\Tools;
use Illuminate\Support\Carbon;
use App\Models\statistics;

class Edit extends Component
{
    use Tools;
   
    public $xmont="";
    public $editable=false, $xMontly=false, $xvalues=[], $xvalue, $xyear;
    public $xmutabley=true;

    public function render()
    {
        
        $montLs=[];
        for ($i = 1; $i <= 12; $i++) {
            $mtn=str_pad($i, 2,"0", STR_PAD_LEFT);
            $montLs[$mtn] = Carbon::createFromFormat('m', $i)->format('F');
        }

        return view('livewire.edit', compact('montLs'));
    }

    public function updated($campo)
    {
        $this->editable=( ($this->xcenter)and($this->xinform)and($this->xmont));

        if (in_array($campo, ['xcenter', 'xinform', 'xmont','xyear']))
            {
                    if ($this->editable) $this->loadvalues();
            }
    }

    public function loadvalues()
    {
        $this->xvalues=[];
        $yemowe=$this->xyear.$this->xmont;
        $data=statistics::whereRaw("SUBSTRING(yearmontweek, 1, 6) = ?", [$yemowe])->
                          where('centers_id', $this->xcenter)->
                          where('information_type_id', $this->xinform)->get();

        if  (count($data)>0){                
                    foreach ($data as $key => $value) {
                        $this->xvalues[ substr($value->yearmontweek, -1,1)]=$value->value;
                    }    

            if (count($data)>1){ $this->xMontly=true; } else {$this->xMontly=false;}
            $this->xmutabley=false;       
        } else {        $this->xmutabley=true;         }
        
    }

    public function save()
    {
        $yemowe=$this->xyear.$this->xmont;
        $nvalue=$this->someValue($this->xvalues);
        if ($this->someValue($this->xvalues))
        {

            /* Limitar que solo se guarden valores mensuales o semanales y no ambos */
            if ((count($this->xvalues)>1)and($this->xMontly)){
                $this->xvalues[0]=0;
            } else { $this->xvalues=[$this->xvalues[0]]; }

            foreach ($this->xvalues as $key => $value) {
                if ($value<>0){
                    $data=statistics::where('yearmontweek',$yemowe.'0'.$key)->
                                      where('centers_id', $this->xcenter)->
                                      where('information_type_id', $this->xinform)->first();
                    
                    if ($data) {
                            $data->value=$value;
                            $data->update();
                        
                    } else {
                        statistics::create([
                            'yearmontweek' => $yemowe.'0'.$key,
                            'centers_id'=>$this->xcenter,
                            'information_type_id'=>$this->xinform,
                            'value'=>$value
                        ]);
                    }
                }
            }
            if (intval($this->xmont)<12) {
                $this->xmont= $mtn=str_pad(intval($this->xmont)+1, 2,"0", STR_PAD_LEFT);
            } else { $this->reset('xmont'); }

            $this->reset('xvalues','xmutabley');    
        }
    }

    public function someValue($array)
{
    // Filtrar los valores diferentes de cero
    $valoresNoCero = array_filter($array, function ($valor) {
        return $valor != 0;
    });

    // Verificar si el array resultante tiene elementos
    return count($valoresNoCero) > 0;
}

}
