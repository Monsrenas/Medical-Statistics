<div class="py-12 h-full">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/build/assets/funciones.js"></script>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="inline py-1   m-0 @if (!$xactiva)py-2 bg-blue-200 @endif text-blue-800 border-solid border-2 border-indigo-800 border-gray-600 border-b-0"
             style="padding-bottom: 5px;">
            <button class="px-4  text-lg w-3/12" n wire:click="$toggle('xactiva')">Graphics</button>
        </div>
        <div class="inline  py-1 m-0 @if ($xactiva) text-bold py-2 bg-blue-200 @endif text-blue-800 border-solid border-2 border-indigo-800 border-gray-600 border-b-0" 
             style="margin-left: -2px; padding-bottom: 5px;">
            <button class="px-4  text-lg w-3/12" n wire:click="$toggle('xactiva')">Tables</button>
        </div>

        <div class=" max-w-7xl mx-auto border-solid border-2 border-gray-600 " >
            <div class="px-10 py-4 w-full flex md:items-center text-lg w-full bg-blue-200 text-blue-800">

                <x-label value="From" />
                <x-input type="date" class="mx-5 mr-10 py-0" wire:model='xFrom' style="font-size: .6em;" />

                <x-label value="To" />
                <x-input type="date" class="ml-5 py-0" wire:model='xTo' style="font-size: .6em;" />

                <button wire:click="searchReset('xinform')" wire:loading.attr="disabled" style="font-size: .7em;"
                        class="p-1 mx-20 rounded-md bg-white text-black hover:bg-gray-800  hover:text-white float-right">
                    Reset
                </button>    
            </div>

            <div class="px-10 py-2 w-full flex md:items-center text-lg w-full bg-blue-200 text-blue-800">
                @include('forms.centers_tInfo_select_nav')
                
                <x-label for="meCoder" class="pl-20 pr-4 text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Table model</x-label>
                <select name="coder_center" wire:model='xtablemodel' style="font-size: .6em;"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
                    <option value="0">Basic comparison</option>
                    <option value="1">Annual Combined</option>
                </select>
            </div>
           
             @include('tables.dash'.$pestana[$xactiva])
    
        </div>
        
    </div>
</div>

