 @if ($editable)
     <div class="p-6" style="box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.3);">                
         @if ($xmutabley)
             <x-label value="Weekly values" class=" inline px-4 text-gray-500 font-bold md:text-left mb-1 md:mb-0 "/>

             <label class="switch">
                 <input type="checkbox" wire:model='xMontly' >
                 <span class="slider round"></span>
             </label>
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
                            <input type="number" wire:model.lazy='xvalues.{{$i}}' placeholder="0.00" style=" border: 0;" class="px-1 text-center">
                        </td>  
                        @endfor
                    
                   
                 @else    
                     <tr>
                         <th class="px-10"> Value</th>
                         <td>
                             <input type="number" wire:model='xvalues.0' placeholder="0.00" style=" border: 0;" class="px-1 text-center">
                         </td>  
                 @endif  
                     @if (!$xmutabley)
                     <td>
                         <a wire:click="$set('showDeleteModal',true)" 
                             class="w-full text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-5  text-center mr-2  dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                             Delete 
                         </a>
                     </td>   
                     @endif
                 </tr>
             </table>
         </div>  

         @if ($xvalues)
            <div class="w-full text-center mt-10">
                <x-button wire:click="save" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-800">
                    Save
                </x-button>
            </div>
         @endif   
    </div>
@endif            