<x-slot name="header">
    <x-tall-table.breadcrumbs url="{{ route($this->list, $etapa) }}" label="{{ __('Fluxo') }}" />
    <x-tall-table.breadcrumbs url="#" label="{{ $title }}" />
</x-slot>
<div class="w-full">
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex  font-sans overflow-hidden">
            <div class="w-full">
                <div class="bg-white shadow-md rounded">
                    @if ($fluxos = \Tall\Fluxo\Models\Fluxo::query()->whereStatus('published')->get())
                        @foreach ($fluxos as $fluxo)
                            @if ($fluxo_etapas = $fluxo->fluxo_etapas)
                                <div class="p-2">
                                    <div class="sm:hidden">
                                        <label for="tabs" class="sr-only">Select a tab</label>
                                        <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                                        <select id="tabs" name="tabs"
                                            class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            @foreach ($fluxo_etapas as $fluxo_etapa)
                                                @can(sprintf('admin.%s.processo.edit', $fluxo->id))
                                                    <option
                                                        data-href="{{ route(sprintf('admin.%s.processo.edit', $fluxo->id), ['etapa' => $fluxo_etapa, 'model' => $model]) }}">
                                                        <span class="uppercase">
                                                            {{ $fluxo_etapa->name }}
                                                        </span>
                                                    </option>
                                                @endcan
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="hidden sm:block">
                                        <div class="border-b border-gray-200">
                                            <nav class="-mb-px flex space-x-8 justify-between" aria-label="Tabs">
                                                @foreach ($fluxo_etapas as $fluxo_etapa)
                                                    @can(sprintf('admin.%s.processo.edit', $fluxo->id))
                                                        <a href="{{ route(sprintf('admin.%s.processo.edit', $fluxo->id), ['etapa' => $fluxo_etapa, 'model' => $model]) }}"
                                                            @if ($fluxo_etapa->id == $etapa->id) class="border-indigo-500 text-indigo-600 whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm"    
                                                        @else
                                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200 whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm"> @endif
                                                            <span class="uppercase">
                                                            {{ $fluxo_etapa->name }}
                                                            </span>
                                                            <span
                                                                class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">{{ $fluxo_etapa->total }}</span>
                                                        </a>
                                                    @endcan
                                                @endforeach
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <form wire:submit.prevent="submit" class="border-t border-gray-200">
                        <x-errors />
                        <div class="grid grid-cols-12 gap-x-4 gap-y-2 p-5">
                            @if ($fluxo_etapa_items = $this->fluxo_etapa_items)
                                @foreach ($fluxo_etapa_items as $field)
                                    @if ($fluxo_field = $field->fluxo_field)
                                        <x-dynamic-component
                                            component="{{ sprintf('tall-form.views.%s', data_get($fluxo_field, 'view', 'text')) }}"
                                            :field="$field" />
                                    @else
                                        <x-dynamic-component
                                            component="{{ sprintf('tall-form.views.%s', data_get($field, 'view', 'text')) }}"
                                            :field="$field" />
                                    @endif
                                @endforeach
                            @endif
                            <div wire:key="etapas" class="col-span-12">
                                <label class="block" for="Etapas">
                                    <span> Selecione a etapa</span>
                                    <select class="w-full  border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                        wire:model.defer="data.fluxo_etapa_id">
                                        <option value="">Selecione Uma etapa</option>
                                        @if ($fluxos = \Tall\Fluxo\Models\Fluxo::query()->whereStatus('published')->get())
                                            @foreach ($fluxos as $fluxo)
                                                @if ($fluxo_etapas = $fluxo->fluxo_etapas)
                                                    @foreach ($fluxo_etapas as $fluxo_etapa)
                                                        <option value="{{ $fluxo_etapa->id }}">
                                                            {{ $fluxo_etapa->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </label>
                            </div>
                            <div class="bg-white px-4 py-5 flex justify-between sm:px-6 col-span-12">
                                @if ($list = $this->list)
                                    <x-button red squared href="{{ route($this->list, $etapa) }}"
                                        icon="arrow-narrow-left" label="{{ __('Voltar para a lista') }}" primary />
                                @endif
                                <x-button icon="save" indigo squared type="submit"
                                    label="{{ __('Salvar alterações') }}" />
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
