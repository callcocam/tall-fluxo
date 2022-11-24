<x-slot name="header">
    <x-tall-table.breadcrumbs url="{{ route($this->list, $etapa) }}" label="{{ __('Fluxos') }}" />
    <x-tall-table.breadcrumbs url="#" label="{{ __('Listar') }}" />
</x-slot>
<div class="w-full">
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex  font-sans">
            <div class="w-full">
                <div class="bg-white shadow-md rounded px-4">
                    <div class="sm:flex sm:items-center px-6 pt-6 pb-4">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">{{ __('Fluxos') }}</h1>
                            @isset($description)
                                <p class="mt-2 text-sm text-gray-700">{{ $description }}</p>
                            @endisset
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 flex items-center space-x-2">
                            <x-tall-table.filters.clear :filters="$filters" />
                            <x-tall-table.search />
                            @if (\Route::has($this->create))
                                <x-tall-table.add href="{{ route($this->create, $etapa) }}">
                                    {{ __('Adicionar') }}
                                </x-tall-table.add>
                            @endif
                            @if (\Route::has($this->order))
                                <x-tall-table.order href="{{ route($this->order) }}" />
                            @endif

                        </div>
                    </div>

                    <table class="w-full table-auto">
                        <thead class="shadow-md rounded-t-sm">
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal rounded-t-md">
                                @if ($fluxo_etapa_items = $this->fluxo_etapa_items)
                                    @foreach ($fluxo_etapa_items as $fluxo_etapa_item)
                                        @if ($fluxo_etapa_item->visible)
                                            @if ($fluxo_etapa_item->listado)
                                                <th class="py-1 px-6 text-left  cursor-pointer">
                                                    <div class="flex flex-col space-y-1">
                                                        @if ($fluxo_etapa_item->sortable)
                                                            <x-tall-table.sort name="{{ $fluxo_etapa_item->name }}">
                                                                {{ __($fluxo_etapa_item->label) }}
                                                            </x-tall-table.sort>
                                                        @else
                                                            {{ __($fluxo_etapa_item->label) }}
                                                        @endif

                                                    </div>
                                                </th>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                                <th class="py-3 px-6 text-center">#</th>
                            </tr>
                        </thead>
                        @if ($models->count())
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach ($models as $model)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        @if ($fluxo_etapa_items = $this->fluxo_etapa_items)
                                            @foreach ($fluxo_etapa_items as $fluxo_etapa_item)
                                                @if ($fluxo_etapa_item->visible)
                                                    @if ($fluxo_etapa_item->listado)
                                                        <td class="py-3 px-6 text-left">
                                                            @if ($fluxo_etapa_item->id)
                                                                @if ($form_db_options = $fluxo_etapa_item->form_db_options)
                                                                    @if ($name = data_get($model, sprintf('produtos.%s', $fluxo_etapa_item->fluxo_field_id)))
                                                                        {{ data_get($form_db_options, $name) }}
                                                                    @endif
                                                                @elseif ($form_options = $fluxo_etapa_item->form_options)
                                                                    @if ($name = data_get($model, sprintf('produtos.%s', $fluxo_etapa_item->fluxo_field_id)))
                                                                        {{ data_get($form_options, $name) }}
                                                                    @endif
                                                                @else
                                                                    {{ data_get($model, sprintf('produtos.%s', $fluxo_etapa_item->fluxo_field_id)) }}
                                                                @endif
                                                            @else
                                                                {{ data_get($model, $fluxo_etapa_item->name) }}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                        <td class="py-3 px-6 text-left">
                                            @include('tall::admin.fluxos.processo.actions')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="w-full p-2 space-x-3">
                                        {{ $models->links() }}
                                    </td>
                                </tr>
                            </tfoot>
                        @else
                            <tr>
                                <td colspan="3" class="w-full p-2 space-x-3">
                                    <x-tall-table.empty />
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
