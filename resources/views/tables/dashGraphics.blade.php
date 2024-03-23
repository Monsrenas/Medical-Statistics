@php
    $iSZ=0;
@endphp


    <div class="grid grid-cols-3 gap-4" >
        @foreach ($list as $ndc=>$inic)  {{-- Iteration of medical centers--}}
        
         
          <h1 class="w-full p-1  mb-0 mt-6 font-bold bg-gray-500 text-white col-span-3 ">{{$centerLs[$ndc]}}</h1> {{-- Medical cnter name --}}
          
            @foreach ($inic as $iIntp=>$dInft)  {{-- Iteration of information type --}}   
               {{-- Information type name --}}
                        
                        @php  $Axe_X=[]; $AllValue=[]; 
                            if (!isset($gSize[$iSZ])) {
                                $gSize[$iSZ]="";
                            }
                        @endphp

                         <div class=" p-2 {{$gSize[$iSZ]}}" wire:click="cambia({{$iSZ}})" >
                            <h1 class="w-full block flex ">{{$informLs[$iIntp]}} </h1>
                            <canvas id="vtn{{$iIntp}}{{$ndc}}" width="600" height="500"></canvas>
                        </div>
                        @php
                             $iSZ++;
                        @endphp
                        {{-- Write the columns with the names of the months --}}
                        @for ($i = 1; $i <= 12; $i++)
                            @php
                                $mtn=str_pad($i, 2,"0", STR_PAD_LEFT);

                                array_push($Axe_X, $montLs[$mtn]); 
                            @endphp
                            
                        @endfor
                        
                        @php  
                           $magnitud=("App\Models\\information_type")::find($iIntp); 
                           $legenLabel=[];
                        @endphp

                        {{-- Iteration of years --}}
                        @foreach ($dInft as $iYrs=>$dYears)                  {{-- Iteration of years --}}

                                @php
                                    array_push($legenLabel, $iYrs);  

                                    $listValue=[];
                                @endphp 
                                @for ($i = 1; $i <= 12; $i++)
                                    
                                        @foreach ($dYears as $iMnts=>$dMonts)                  {{-- Iteration of monts --}}
                                            @php
                                            $mes=substr(strval($iMnts), -2, 2);   
                                            @endphp

                                                @if (intval($mes)==$i)
                                                    @php $totalMonth=0; @endphp
                                                    @foreach ($dMonts as $dWeek)
                                                        @php  
                                                          $totalMonth=$totalMonth+$dWeek['value'];  
                                                        @endphp
                                                    @endforeach
                                                    
                                                    @php
                                                        array_push($listValue, $totalMonth);  
                                                    @endphp 
                                                            
                                                @endif    
                                                                
                                        @endforeach
                                @endfor             
                                    
                                    @php
                                        array_push($AllValue, $listValue);  
                                    @endphp 
                        @endforeach
                        
                @php
                    echo "<script>";   
                    echo "console.log('Salen datos');";    
                    echo "generarGraficoLineas(".json_encode($Axe_X).", ".json_encode($AllValue).",".json_encode($legenLabel).",'vtn".$iIntp.$ndc."');";    
                    echo "</script>";    
                @endphp
            @endforeach
        @endforeach            
    </div>