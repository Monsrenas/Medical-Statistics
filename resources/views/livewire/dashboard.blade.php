<div class="py-12 h-full">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="inline h-32 border-solid border-2 border-indigo-800 border-gray-600 border-b-0">
            <button class="px-4  text-lg w-3/12" n wire:click="$toggle('xactiva')">{{$pestana[!$xactiva]}}</button>
        </div>
        <div class=" max-w-7xl mx-auto border-solid border-2 border-gray-600 ">
            <div class="ml-20  text-lg w-3/12  ">{{$pestana[$xactiva]}}</div>

            
               
            @include('tables.dash'.$pestana[$xactiva])
                    
                
        
        </div>
        
    </div>
</div>
