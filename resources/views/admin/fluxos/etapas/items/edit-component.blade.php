<div class="w-full">
    <div class="bg-white px-5 rounded">
        <form wire:submit.prevent="submit" class="flex items-center p-3 border rounded-md w-full space-x-2">
            <div class=" w-full">
                <div class="mt-1">
                    <input title="Nome ou Rotulo para item" type="text" wire:model.lazy='data.name'
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Nome ou Rotulo para item">
                </div>
            </div>
            <div>
                <div class="mt-1">
                    <input title="Tipo do item" type="text" wire:model.lazy='data.type'
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Tipo do item">
                </div>
            </div>
            <div class="w-full">
                <div class="mt-1">
                    <select type="text" wire:model.lazy='data.fluxo_field_id'
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Tipo do item">
                        <option>Selecione</option>
                        @if ($fluxo_fields = $this->fluxo_fields)
                            @foreach ($fluxo_fields as $key => $value)
                                <option value="{{$key}}">{{ $value }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div>
                <div class="mt-1">
                    <input type="text" wire:model.lazy='data.ordering'
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="00">
                </div>
            </div>
            <div class=" w-50 flex items-center space-x-2">
                <button class="p-1">
                    <x-tall-icon name="pencil" class="h-6 w-6" />
                </button>
                <button type="button" class="p-1"  wire:click='delete'>
                    <x-tall-icon name="trash" class="h-6 w-6" />
                </button>
                <x-tall-icon name="arrows-expand" class="h-6 w-6 draggable-handler" />
            </div>
        </form>
    </div>
</div>
