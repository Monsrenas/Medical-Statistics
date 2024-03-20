<x-label value="Name" />
---

<x-label value="Date Start" />
<x-input-error for="field.1" class="mt-2" />
<x-input type="date" class="w-full" wire:model='field.1' />

<x-label value="Date End" />
<x-input-error for="field.2" class="mt-2" />
<x-input type="date" class="w-full" wire:model='field.2' />
