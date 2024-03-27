{{-- 1->  (Year, Medical center, Information type, Mont)  --}}
<div>

@foreach ($list as $iYrs=>$dYears)  {{-- Iteration of years--}}


<h1 class="w-full p-1  mb-0 mt-6 font-bold bg-gray-500 text-white">{{$iYrs}}</h1> {{-- Year name --}}
    @foreach ($dYears as $iMdc=>$dMdc)  {{-- Iteration of medical center --}}
          
        <table class="w-full mt-4 text-sm text-left text-gray-500 dark:text-gray-400">
            <tr>
                <th colspan="14" class="px-4 bg-gray-400 text-black" style="width: 100px; min-width:100px "> {{-- Information type name --}}
                    {{$centerLs[$iMdc]}} {{-- Medical cnter name --}}
                </th>    
            </tr>
            <tr>
                <th class="text-center bg-gray-300 text-black">
                    
                </th>
                {{-- Write the columns with the names of the months --}}
                @for ($i = 1; $i <= 12; $i++)
                    @php
                        $mtn=str_pad($i, 2,"0", STR_PAD_LEFT);
                    @endphp
                    
                    <th class="text-center  bg-gray-300 text-black"> 
                        {{substr($montLs[$mtn],0,3)}}
                    </th>
                @endfor
                <th class="text-center  bg-gray-300 text-black"></th> {{--Calendar YTD--}}
            </tr>
            <tbody>
                {{-- Iteration of information --}}
                @foreach ($dMdc as $iIfmt=>$dIfmt)                  {{-- Iteration of Information type --}}
                    @php $totalYear=0; $magnitud=("App\Models\\information_type")::find($iIfmt); @endphp
                    <tr>
                        <th class="text-left bg-gray-300 text-black ml-8">
                            {{$informLs[$iIfmt]}}
                        </th>

                        @for ($i = 1; $i <= 12; $i++)
                            <td class="text-center px-2">
                                @foreach ($dIfmt as $iMnts=>$dMonts)                  {{-- Iteration of monts --}}
                                    @php
                                    $mes=substr(strval($iMnts), -2, 2);   
                                    @endphp
                                    
                                    @if (intval($mes)==$i)
                                        @php $totalMonth=0; @endphp
                                        @foreach ($dMonts as $dWeek)
                                        @php  $totalMonth=$totalMonth+$dWeek['value']; $totalYear=$totalYear+$totalMonth  @endphp
                                        @endforeach
                                        {{($totalMonth)}}  
                                    @endif   
                                @endforeach
                            </td>
                        @endfor

                        <td class="text-center px-2 font-bold text-green-700">
                            @if ($magnitud->magnitude=='%')
                            {{(round($totalYear/count($dIfmt),2))}}
                           @else
                            {{($totalYear)}}
                           @endif
                        </td>    
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