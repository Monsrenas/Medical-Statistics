<div>
@foreach ($list as $ndc=>$inic)  {{-- Iteration of medical centers--}}


<br>{{$centerLs[$ndc]}} {{-- Medical cnter name --}}
    @foreach ($inic as $iIntp=>$dInft)  {{-- Iteration of information type --}}
          
        <table class="w-full mt-4 text-sm text-left text-gray-500 dark:text-gray-400">
            <tr>
                <th colspan="12" class="px-4"> {{-- Information type name --}}
                    {{$informLs[$iIntp]}}
                </th>    
            </tr>
            <tr>
                <th>
                    
                </th>
                {{-- Write the columns with the names of the months --}}
                @for ($i = 1; $i < 12; $i++)
                    @php
                        $mtn=str_pad($i, 2,"0", STR_PAD_LEFT);
                    @endphp
                    
                    <th> 
                        {{substr($montLs[$mtn],0,3)}}
                    </th>
                @endfor
            </tr>
            <tbody>
                {{-- Iteration of years --}}
                @foreach ($dInft as $iYrs=>$dYears)                  {{-- Iteration of years --}}
                    <tr>
                        <td class="text-center">
                            {{$iYrs}}
                        </td>
                        @foreach ($dYears as $iMnts=>$dMonts)                  {{-- Iteration of monts --}}
                            @php
                               $mes=substr(strval($iMnts), -2, 2);   
                            @endphp

                            @for ($i = 1; $i < 12; $i++)
                                @if (intval($mes)==$i)
                                    <td>
                                        {{($mes)}}
                                    </td>        
                                @endif    
                            
                            @endfor                      
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    @endforeach
@endforeach



@php
//dd($list);    
@endphp
</div>