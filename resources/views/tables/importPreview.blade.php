@if ($importTable)
    <div class="p-2 col-span-2 ">
        <table class="w-full mt-4 text-sm text-left text-gray-500 dark:text-gray-400">
            @foreach ($importTable[0] as $item)
                <th>
                    {{$item}}
                </th>
            @endforeach
            @for ($i = 1; $i <= count($importTable)-1; $i++)
            <tr>    
                <th>{{$importTable[$i][0]}}</th>
                @for ($y = 1; $y <= count($importTable[$i])-1; $y++)
                <td>
                    {{$importTable[$i][$y]}}
                </td>    
                @endfor
            </tr>    
            @endfor
        </table>
        @if (($xcenter)and($xinform))
        <div class="w-full text-center mt-10">
            <x-button wire:click="saveImportedDate" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-800">
                Save
            </x-button>
        </div>
        @endif
    </div>      
@endif

