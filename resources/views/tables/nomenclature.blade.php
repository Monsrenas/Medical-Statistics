
<div class="relative h-fit shadow-md sm:rounded-lg">
    
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @foreach ($columna as $item)
                <th scope="col" class="px-2 py-3">
                    {{$item}}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
         {{$color=false}}
            {{$actual=''}}

            @php    $i=(($page-1)*10)+1;   @endphp    
            
            @foreach ($lista as $item)
                @php
                    if ($item->details_id<>$actual){
                        $actual=$item->details_id;
                        $color=!$color;
                        $i=($i==0)?(1):(($i));      }
                @endphp
                <tr class="{{($color)?'bg-gray-200':'bg-white'}} text-center border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-sky-200 hover:text-black dark:hover:bg-gray-600">
                   {{-- <td class="w-4 text-gray-400">
                        {{$i++}}
                    </td> --}}
                    @foreach ($columna as $colu)
                        <td scope="col" class="px-2 py-3">
                            {{$item[$colu]}}
                        </td>
                    @endforeach
                   
                    <td class="px-6 text-center">
                        <a wire:click="edit({{ $item->id }})"
                            class="w-full text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-5  text-center mr-2  dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                            Edit
                        </a>
                        @if ((!isset($item->register)) or (count($item->register)<=0))
                        <a wire:click="confirmDelete({{ $item->id }},'{{ $item->first_name }} {{ $item->last_name }}')" 
                            class="w-full text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-5  text-center mr-2  dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Delete 
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach 
            
        </tbody>
    </table>
    <div class="mt-1">
        {{ $lista->links() }}
    </div>    
</div>
