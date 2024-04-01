<div>
    @foreach ($list as $ndc=>$inic)  {{-- Iteration of medical centers--}}
    
    
    <h1 class="w-full p-1  mb-0 mt-6 font-bold bg-gray-500 text-white">{{$centerLs[$ndc]}}</h1> {{-- Medical cnter name --}}
        @foreach ($inic as $iIntp=>$dInft)  {{-- Iteration of information type --}}
        <h2 class="w-full px-1  mb-0 mt-2 font-bold bg-gray-400  text-black">{{$informLs[$iIntp]}}</h2>
          <div style="max-width: 100%; overflow-x:scroll;" class="px-0 pb-4">    
            <table class="w-full mt-0 text-sm text-left text-gray-500 dark:text-gray-400" >
                <tr>
                    <th class="text-center bg-gray-300 text-black">
                        
                    </th>
                    @foreach ($dInft as $iYrs=>$dYears) 
                    {{-- Write the columns with the names of the months --}}
                    @for ($i = 1; $i <= 12; $i++)
                        @php
                            $mtn=str_pad($i, 2,"0", STR_PAD_LEFT);
                        @endphp
                        
                        <th class="text-center  bg-gray-300 text-black px-4"> 
                            {{substr($montLs[$mtn],0,3)}}-{{substr($iYrs,-2,2)}}
                        </th>
                    @endfor
                    @endforeach
                </tr>
                <tbody>
                    <tr>
                        <th class="text-center bg-gray-300 text-black">
                             
                        </th>
                    {{-- Iteration of years --}}
                    @foreach ($dInft as $iYrs=>$dYears)                  {{-- Iteration of years --}}
                        @php $totalYear=0; @endphp
                     
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="text-center px-2">
                                    @foreach ($dYears as $iMnts=>$dMonts)                  {{-- Iteration of monts --}}
                                        @php
                                        $mes=substr(strval($iMnts), -2, 2);   
                                        @endphp
    
                                            @if (intval($mes)==$i)
                                                @php $totalMonth=0; @endphp
                                                @foreach ($dMonts as $dWeek)
                                                    @php  
                                                      $totalMonth=$totalMonth+$dWeek['value']; $totalYear=$totalYear+$totalMonth  
                                                    @endphp
                                                @endforeach
                                                
                                                {{($totalMonth)}}
                                                        
                                            @endif    
                                                            
                                    @endforeach
                                </td>
                            @endfor              
                       
                    @endforeach
                    </tr>
                </tbody>
                
            </table>
        </div>
        @endforeach
    @endforeach
    
    
    
    @php
    //dd($list);    
    @endphp
    </div>