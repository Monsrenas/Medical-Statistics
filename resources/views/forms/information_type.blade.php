<x-label value="Name" />
<x-input type="text" class="w-full mb-14" wire:model='field.1' />
<x-input-error for="name" class="mt-2" />

<x-label value="Magnitude" />
<select name="magnitude" id="meMag" name="meMag" wire:model='field.2'
    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-max py-2  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
    <option value="#">Number</option>
    <option value="%">Percent</option>
</select>