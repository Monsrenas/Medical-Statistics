@if ($ximport)
    <div class="p-2 mx-auto grid grid-cols-3 gap-4 md:items-center" style="box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.3);">                
        <div class="text-center p-2">
            <textarea name="import" id="" cols="30" rows="10" wire:model='importData' 
                    placeholder="From a spreadsheet-type document, copy the data table you want to import and paste it here."
            style="-webkit-input-placeholder {
                text-align: center;
                line-height: 100px;">

            </textarea>

            @if ($importData) 
                <div class="w-full text-center  ">
                    <button wire:click="importarDatos()" wire:loading.attr="disabled" style="font-size: .7em;"
                                            class="p-1  rounded-md border-1  bg-white text-black hover:bg-gray-800  hover:text-white ">
                                            Review information
                    </button>   
                </div>
            @endif 
        </div>

        @include('tables.importPreview')
    </div>    
@endif