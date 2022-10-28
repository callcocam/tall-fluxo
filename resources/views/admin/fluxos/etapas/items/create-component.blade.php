<div class="w-full px-5">
    <div x-data="{ expanded: false }">
        <fieldset class="bg-white shadow-md p-2 rounded rounded-lg border">
            <legend>Cadastrar Items para - <b>{{ $model->name }}</b></legend>
            <form wire:submit.prevent="submit" class="flex items-center p-3 w-full space-x-2">
                <div class=" w-full">
                    <div class="mt-1">
                        <input title="Nome da item" type="text" wire:model.lazy='data.fluxo_etapa_items.name'
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Nome da item">
                    </div>
                </div>
                <div class=" w-full">
                    <div class="mt-1">
                        <input title="Tipo do item"" type="text" wire:model.lazy='data.fluxo_etapa_items.type'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Tipo do item">
                    </div>
                </div>
                <div>
                    <div class="mt-1">
                        <input title="Ordem" type="text" wire:model.lazy='data.fluxo_etapa_items.ordering'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="00">
                    </div>
                </div>
                <div class=" w-50 flex space-x-2">
                    <button>
                        <x-tall-icon name="plus" class="h-6 w-6" />
                    </button>
                    @if ($model->fluxo_etapa_items->count())
                        <button type="button" x-on:click="expanded = ! expanded">
                            <x-tall-icon x-show="!expanded" name="chevron-down" class="h-6 w-6" />
                            <x-tall-icon x-show="expanded" name="chevron-up" class="h-6 w-6" />
                        </button>
                    @endif
                </div>
            </form>
            <div x-show="expanded" x-collapse>
                @if ($fluxo_etapa_items = $model->fluxo_etapa_items)
                    @foreach ($fluxo_etapa_items as $fluxo_etapa_items)
                        <x-tall-sortable>
                            <div  class="w-full sortable" data-id="{{ $fluxo_etapa_items->id }}">
                                @livewire('tall::admin.fluxo.etapas.items.edit-component', ['model' => $fluxo_etapa_items], key(uniqId($fluxo_etapa_items->id)))
                            </div>
                        </x-tall-sortable>
                    @endforeach
                @endif
            </div>
        </fieldset>
    </div>
</div>
