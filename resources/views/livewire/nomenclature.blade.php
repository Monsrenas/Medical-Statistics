<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
        <div class="w-full  flow-root">
            <div class="w-full flex md:items-center mb-6">
                <x-label for="meCoder" class="px-4 text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Nomenclator</x-label>

                <select name="coder_type" id="meCoder" name="meCoder" wire:model='xcoder'
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
                    <option value="" disabled selected hidden>Select nomenclator</option>
                    <option value="centers">Medical center</option>
                    <option value="information_type">Type of information</option>
                    <option value="period">Periods</option>
                </select>
                
                @if ($xcoder)
                    <div class="w-full justify-end content-end">
                        <x-button wire:click="new" class="float-right bg-green-700 hover:bg-green-600">
                            New
                        </x-button>
                    </div>
                @endif
            </div>
        </div>
    </div>  
    
    
        <!-- Modal de Crear/editar -->
        <x-dialog-modal wire:model="open">
            <x-slot name='title'>
                <div class="inline-flex">
                    <p class="uppercase px-4 text-xl"> {{ $this->postToEdit ? 'Edit' : 'Create' }} {{ $this->xcoder }}</p>
                </div>
    
            </x-slot>
            <x-slot name='content'>
                @if ($xcoder)
                    @include('forms.'.$xcoder)
                @endif
            </x-slot>
            <x-slot name='footer'>
                <x-secondary-button wire:click="save" wire:loading.attr="disabled">
                    Save
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
</div>
