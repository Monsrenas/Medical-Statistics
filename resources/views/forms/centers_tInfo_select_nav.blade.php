<div class="flex grid grid-cols-2 gap-4 md:items-center">
 <x-label for="meCoder" class=" text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Medical center</x-label>
   <select name="coder_center" wire:model='xcenter' style="font-size: .6em;"
       class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
       <option value="" selected>All</option>
       @foreach  ($centerLs as $ndc=>$colu)
        <option value="{{$ndc}}">{{$colu}}</option>
       @endforeach
   </select>
</div>

<div class="flex grid grid-cols-2 gap-4 md:items-center">
   <x-label for="coder_info" class="ml-8 text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Information</x-label>
   <select name="coder_info" wire:model='xinform' style="font-size: .6em;"
       class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
       <option value=""  selected>All type</option>
       @foreach  ($informLs as $ndc=>$colu)
        <option value="{{$ndc}}">{{$colu}}</option>
       @endforeach
   </select>
</div>