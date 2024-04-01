<div class="grid grid-cols-1 gap-2" >
    @php    $iSZ=0;     $xScripts=[];   @endphp

        @foreach ($list as $ndc=>$inic)  {{-- Iteration of medical centers--}}
         
          <h1 class="w-full p-1  mb-0 mt-6 font-bold bg-gray-500 text-white col-span-1 ">{{$centerLs[$ndc]}}</h1> {{-- Medical cnter name --}}
          
            @foreach ($inic as $iIntp=>$dInft)  {{-- Iteration of information type --}}   
               {{-- Information type name --}}
                        
                        @php  
                            $listValue=[];

                            $Axe_X=[]; $AllValue=[]; 
                            if (!isset($gSize[$iSZ])) {
                                $gSize[$iSZ]="";
                            }
                            $oldWindows[$iSZ]='Mac'.$iIntp.$ndc;
                        @endphp

                        <div class="p-2 w-full {{$gSize[$iSZ]}}"  id="Tre{{$iIntp}}{{$ndc}}" style="max-width: 100%; overflow-x:scroll;" >
                            <h1 class="w-full block  ">{{$informLs[$iIntp]}} </h1>
                            <canvas class="w-full" id="vtn{{$iIntp}}{{$ndc}}"  ></canvas>
                        </div>

                        @php   $iSZ++;   $legenLabel=["Trend"]; $Axe_X=[];  @endphp

                        {{-- Iteration of years --}}
                        @foreach ($dInft as $iYrs=>$dYears)                  {{-- Iteration of years --}}
                                
                                @for ($i = 1; $i <= 12; $i++)

                                   {{-- Write the columns with the names of the months --}}
                                    @php   
                                        $mtn=str_pad($i, 2,"0", STR_PAD_LEFT);
                                        array_push($Axe_X, $montLs[$mtn]."-".substr($iYrs,-2,2)); 
                                     @endphp
                            
                                    
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
                                  
                        @endforeach
                       
                        @php    array_push($AllValue, $listValue);  @endphp 
                        @php
                            $xScripts[]=" generarGraficoLineas(".json_encode($Axe_X).", ".json_encode($AllValue).",".json_encode($legenLabel).",'vtn".$iIntp.$ndc."','Tre');"
                       @endphp  
            @endforeach
           
           

        @endforeach    

       
        @php
            echo "<script defer>"; 
            foreach ($xScripts as $key => $value) {
            echo $value;
            }
            echo "</script>"; 
       @endphp
        
</div>

               