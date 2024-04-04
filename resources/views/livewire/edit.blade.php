    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex md:items-center mb-6">
                <x-label for="meCoder" class="px-4 text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Year</x-label>
                <x-input type="number" min="1900" max="2099" step="1" value="2024" wire:model='xyear' style="font-size: .8em;"/>

            </div>
            <div class="w-full  md:items-center mb-6  grid grid-cols-4 gap-4">
               
                @include('forms.centers_tInfo_select_nav')
                
                <div class="flex mx-auto grid grid-cols-2 gap-4 md:items-center">
                    @if (!$ximport)
                    <x-label for="coder_mont" class="text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Month</x-label>
                        <select name="coder_mont" wire:model='xmont' style="font-size: .6em;"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
                            <option value=""  selected >All</option>
                            @foreach  ($montLs as $key => $colu)
                            <option value="{{$key}}">{{$colu}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                
                <div class="flex  mx-auto grid grid-cols-2 gap-4 md:items-center">
                    <x-label for="coder_mont" class="ml-8 px-4 text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-">Import</x-label>

                <label class="switch">
                        <input type="checkbox" wire:model='ximport' >
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            
            @include ('forms.edit')
            @include('forms.import')
        </div>

    <!-- Modal de confirmacion de borrado -->
    <x-confirmation-modal wire:model="showDeleteModal">
        <x-slot name='title'>
            <h5 class="modal-title">Deletion Confirmation</h5>
        </x-slot>
        <x-slot name='content'>
            Are you sure you want to <span class="text-red-700"> delete </span> this values?
        </x-slot>
        <x-slot name='footer'>
            <x-button wire:click="$set('showDeleteModal',false)" wire:loading.attr="disabled">
                Cancel
            </x-button>
            <x-danger-button wire:click="deleteValue" wire:loading.attr="disabled" class="mx-14">
                Delete
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    <div wire:loading.delay class="z-auto static flex fixed left-0 top-0 bottom-0 w-full bg-gray-400 bg-opacity-50 align-middle m-auto p-auto">
        <img src="https://paladins-draft.com/img/circle_loading.gif" width="64" height="64" class="m-auto mt-1/4">
    </div>
</div>

    
