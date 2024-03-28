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
    public $editable=false, $xMontly=false, $xvalues=[], $xvalue, $xyear, $ximport=false;
    public $xmutabley=true, $showDeleteModal=false;
    public $importData="", $importTable=[];


    public function render()
    {
        
        $montLs=$this->ListMonts();
   

        return view('livewire.edit', compact('montLs'));
    }

    public function ListMonts()
    {
        for ($i = 1; $i <= 12; $i++) {
            $mtn=str_pad($i, 2,"0", STR_PAD_LEFT);
            $montLs[$mtn] = Carbon::createFromFormat('m', $i)->format('F');
        }

        return  $montLs;
    }

    public function updated($campo)
    {
        $this->editable=( ($this->xcenter)and($this->xinform)and($this->xmont));

        if (in_array($campo, ['xcenter', 'xinform', 'xmont','xyear'])) { if ($this->editable) $this->loadvalues(); }

        if (($campo='ximport')) {  if ($this->ximport) {$this->reset('xvalues','xmutabley','xmont','editable');}
                                   else {$this->reset('importTable');}  }    
    }

    public function loadvalues()
    {
        if ($this->xyear > date('Y')or($this->xyear<1900)) $this->xyear=date('Y'); // Asegurar que no se registre informacion de un tiempo posterior al actual

        $this->xvalues=[];
        $yemowe=$this->xyear.$this->xmont;
        $data=statistics::whereRaw("SUBSTRING(yearmontweek, 1, 6) = ?", [$yemowe])->
                          where('centers_id', $this->xcenter)->
                          where('information_type_id', $this->xinform)->get();

        if  (count($data)>0){                
                    foreach ($data as $key => $value) {
                        $this->xvalues[ substr($value->yearmontweek, -1,1)]=$value->value;
                    }    

            if (!isset($this->xvalues[0])){ $this->xMontly=true; } else {$this->xMontly=false;}
            $this->xmutabley=false;       
        } else {        $this->xmutabley=true;         }
        
    }

    public function save()
    {
        if ($this->xyear > date('Y')or($this->xyear<1900)) $this->xyear=date('Y'); // Asegurar que no se registre informacion de un tiempo posterior al actual

        $yemowe=substr($this->xyear, 0, 4).$this->xmont;
        
        $nvalue=$this->someValue($this->xvalues);
    
        if ($this->someValue($this->xvalues))
        {
            /* Limitar que solo se guarden valores mensuales o semanales y no ambos */
            if ((count($this->xvalues)>1)and($this->xMontly)){
                $this->xvalues[0]=0;
            }

            foreach ($this->xvalues as $key => $value) {
                if (intval($value)<>0){
                    $data=statistics::where('yearmontweek',$yemowe.'0'.$key)->
                                      where('centers_id', $this->xcenter)->
                                      where('information_type_id', $this->xinform)->first();
                    
                    if ($data) {
                            $data->value=(intval($value));
                            $data->update();
                        
                    } else {
                        statistics::create([
                            'yearmontweek' => $yemowe.'0'.$key,
                            'centers_id'=>$this->xcenter,
                            'information_type_id'=>$this->xinform,
                            'value'=>intval($value)
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

    public function saveImportedDate()
    {
        $actualYear=$this->xyear;
        
        for ($i = 1; $i <= count($this->importTable)-1; $i++) {   
            $this->xyear=$this->importTable[$i][0];
            for ($y = 1; $y <= count($this->importTable[$i])-1; $y++)
            {
                $this->xmont=str_pad($y, 2,"0", STR_PAD_LEFT);;
                $this->xvalues[0]= number_format((float)$this->importTable[$i][$y], 2, '.', '');
                $this->save();
            }
        }

        $this->xyear=$actualYear;
        $this->reset('importTable', 'xmont');    

    }

    public function importarDatos()
    {
        // Separar los datos del textarea por filas
        $filas = explode("\n", $this->importData);

        // Inicializar un array para almacenar los datos importados
        $datosImportados = [];

        // Recorrer cada fila
        foreach ($filas as $fila) {
            // Separar los datos de cada fila por columnas
            $columnas = explode("\t", $fila);
        
            $first=((intval($columnas[0])>=1900)and(intval($columnas[0])<=3000));
            
            if (count($datosImportados)<=0) {
                if ($this->buscarCoincidenciaNombreMes($columnas)) {$first=true;}
                else { $datosImportados[]=array_merge([''], array_slice(array_values($this->ListMonts()),0,count($columnas)-1));}
            }

            if ($first) {
                // Agregar las columnas a los datos importados
                $datosImportados[] = $columnas;
            }
        }

        // Hacer algo con los datos importados (guardar en la base de datos, por ejemplo)
        // Aquí puedes utilizar el array $datosImportados como desees

        // Limpiar el textarea después de importar los datos
        $this->importData = '';
        $this->importTable=$datosImportados;
    }

    public function buscarCoincidenciaNombreMes($columnas){
        $montLs=$this->ListMonts();
        foreach ($columnas as $key1 => $texto) {
            foreach ($montLs as $key => $value) { 
               
                if ((gettype((strpos($value,$texto)))==="integer")and($texto)) {
                    
                    return true;}
            }
        } 
       return false;
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

    public function deleteValue()
    {
        $yemowe=$this->xyear.$this->xmont;
        foreach ($this->xvalues as $key => $value) {
            
                $data=statistics::where('yearmontweek',$yemowe.'0'.$key)->
                                where('centers_id', $this->xcenter)->
                                where('information_type_id', $this->xinform)->first();
                
                if ($data) {
                        $data->value=$value;
                        $data->delete();    
                } 
            
        }

        $this->reset('xvalues','xmutabley','showDeleteModal'); 
    }

}
