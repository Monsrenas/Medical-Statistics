<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\Tools;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;
use App\Models\statistics;

class Dashboard extends Component
{
    use Tools;

    public $xtablemodel=0;
    public $pestana=[0=>'Graphics',1=>'Tables'], $xactiva=true;
    public $xFrom,$xTo;
    public function render()
    {
        $list=$this->TbQuery();
        $montLs=[];
        for ($i = 1; $i <= 12; $i++) {
            $mtn=str_pad($i, 2,"0", STR_PAD_LEFT);
            $montLs[$mtn] = Carbon::createFromFormat('m', $i)->format('F');
        }

        return view('livewire.dashboard',compact(['list','montLs']));
    }

    public function TbQuery()
    {
        $squema=[['centers_id','information_type_id','year','mes'],
                 [ 'year','centers_id','information_type_id','mes']]; 
        //0->  (Medical center, Information type,Year, Mont)
        //1->  (Year, Medical center, Information type, Mont)

        return statistics::orderBy('yearmontweek') 
        ->when(($this->xcenter), function($q){
                                                return $q->where('centers_id',$this->xcenter);
                                             })
        ->when(($this->xinform), function($q){
                                                return $q->where('information_type_id',$this->xinform);
                                             }) 
        ->when(($this->xFrom), function($q) {
                                                return $q->where(DB::raw("DATE(CONCAT(SUBSTRING(yearmontweek, 1, 6),'01'))"), '>=', $this->xFrom);
                                             })  
        ->when(($this->xTo), function($q) {
                                                return $q->where(DB::raw("DATE(CONCAT(SUBSTRING(yearmontweek, 1, 6),'01'))"), '<=', $this->xTo);
                                             })  
        ->select('*',DB::raw("SUBSTRING(yearmontweek, 1, 4) as year"),  
                     DB::raw("SUBSTRING(yearmontweek, 1, 6) AS mes"),) 
        ->get()
        ->groupBy($squema[$this->xtablemodel])
        ->toArray();

        
/*
        return DB::table('statistics')
        ->addSelect(
            DB::raw("SUBSTRING(yearmontweek, 1, 6) AS mes"),
            DB::raw("SUM(value) AS suma_valor_mes")
        )
        ->groupBy(DB::raw("SUBSTRING(yearmontweek, 1, 6)")) // Agrupa por mes
        ->get(); 
*/

    }
    public function searchReset()
    {
        $this->reset('xcenter','xinform','xFrom','xTo');
    }
}
