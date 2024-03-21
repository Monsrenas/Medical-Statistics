
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex md:items-center mb-6">
                <x-label for="meCoder" class="px-4 text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Year</x-label>
                <x-input type="number" min="1900" max="2099" step="1" value="2024" wire:model='xyear' />

            </div>
            <div class="w-full flex md:items-center mb-6">
                @include('forms.centers_tInfo_select_nav')

                <x-label for="coder_mont" class="ml-8 px-4 text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Mont</x-label>

                <select name="coder_mont" wire:model='xmont'
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
                    <option value=""  selected hidden>Select mont</option>
                    @foreach  ($montLs as $key => $colu)
                     <option value="{{$key}}">{{$colu}}</option>
                    @endforeach
                </select>
            </div>
            @if ($editable)
                
                @if ($xmutabley)
                    <x-input type="checkbox" class="" wire:model='xMontly' name="Montly"  />
                    <x-label value="Weekly values" class=" inline px-4 text-gray-500 font-bold md:text-left mb-1 md:mb-0 "/>
                @endif

                <div class="mt-10">
                    <table class=" min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        @if ($xMontly)            
                            
                                    <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                                        <tr>
                                            <th class="px-10">Weeks</th>
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <th class="px-10"> Values</th>
                                        @for ($i = 1; $i <= 4; $i++)
                                        <td>
                                            <input type="number" wire:model='xvalues.{{$i}}' placeholder="0.00" style=" border: 0;" class="px-1 text-center">
                                        </td>  
                                        @endfor
                                    </tr>
                            
                        @else    
                            <tr>
                                <th class="px-10"> Value</th>
                                <td>
                                    <input type="number" wire:model='xvalues.0' placeholder="0.00" style=" border: 0;" class="px-1 text-center">
                                </td>  
                            </tr>
                        @endif  
                    </table>
                </div>  
                <div class="w-full text-center mt-10">
                    <x-button wire:click="save" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-800">
                        Save
                    </x-button>
                </div>
            @endif
        </div>
      
    </div>

