                <x-label for="meCoder" class="px-4 text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Medical center</x-label>

                <select name="coder_center" wire:model='xcenter'
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
                    <option value="" selected hidden>Select center</option>
                    @foreach  ($centerLs as $ndc=>$colu)
                     <option value="{{$ndc}}">{{$colu}}</option>
                    @endforeach
                </select>

                <x-label for="coder_info" class="ml-8 px-4 text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Information</x-label>

                <select name="coder_info" wire:model='xinform'
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
                    <option value=""  selected hidden>Select information type</option>
                    @foreach  ($informLs as $ndc=>$colu)
                     <option value="{{$ndc}}">{{$colu}}</option>
                    @endforeach
                </select>