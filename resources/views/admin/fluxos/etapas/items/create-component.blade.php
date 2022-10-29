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
                        <select title="Tipo do item" wire:model.lazy='data.fluxo_etapa_items.type'
                            class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            @if ($form_field_types = $this->form_field_types)
                                @foreach ($form_field_types as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="w-full">
                    <div class="mt-1">
                        <select title="Evento" wire:model.lazy='data.fluxo_etapa_items.evento'
                            class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            @foreach (['model', 'lazy', 'defer'] as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="w-full">
                    <div class="mt-1">
                        <select title="Tamanho" wire:model.lazy='data.fluxo_etapa_items.width'
                            class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            @foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="w-full">
                    <div class="mt-1">
                        <select wire:model.lazy='data.fluxo_field_id'
                            class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option>Selecione</option>
                            @if ($fluxo_fields = $this->fluxo_fields)
                                @foreach ($fluxo_fields as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="w-48">
                    <div class="mt-1">
                        <div class="relative flex items-start py-4">
                            <div class="mr-2 flex h-5 items-center">
                                <input id="visible-{{ $model->id }}" value="1" type="checkbox"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                    wire:model.lazy='data.fluxo_etapa_items.visible' />
                            </div>
                            <div class="min-w-0 flex-1 text-sm">
                                <label for="visible-{{ $model->id }}"
                                    class="select-none font-medium text-gray-700">Visivel</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-72">
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
                            <div class="w-full sortable" data-id="{{ $fluxo_etapa_items->id }}">
                                @livewire('tall::admin.fluxo.etapas.items.edit-component', ['model' => $fluxo_etapa_items], key(uniqId($fluxo_etapa_items->id)))
                            </div>
                        </x-tall-sortable>
                    @endforeach
                @endif
            </div>
        </fieldset>
    </div>
</div>
