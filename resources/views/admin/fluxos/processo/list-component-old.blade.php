<x-slot name="header">
    <x-tall-table.breadcrumbs url="{{ route($this->list, $etapa) }}" label="{{ __('Fluxos') }}" />
    <x-tall-table.breadcrumbs url="#" label="{{ __('Listar') }}" />
</x-slot>
<div class="w-full">
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex  font-sans overflow-hidden">
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
                                <x-tall-table.add href="{{ route($this->create, $path) }}">
                                    {{ __('Adicionar') }}
                                </x-tall-table.add>
                            @endif
                            @if (\Route::has($this->order))
                                <x-tall-table.order href="{{ route($this->order) }}" />
                            @endif

                        </div>
                    </div>
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
                                                @can(sprintf('admin.%s.processo', $fluxo->id))
                                                    <option
                                                        data-href="{{ route(sprintf('admin.%s.processo', $fluxo->id), ['etapa' => $fluxo_etapa]) }}">
                                                        <span class="uppercase">
                                                            {{ $fluxo_etapa->name }}
                                                        </span></option>
                                                @endcan
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="hidden sm:block">
                                        <div class="border-b border-gray-200">
                                            <nav class="-mb-px flex space-x-8 justify-between" aria-label="Tabs">
                                               @foreach ($fluxo_etapas as $fluxo_etapa)
                                                    @can(sprintf('admin.%s.processo', $fluxo->id))
                                                        <a href="{{ route(sprintf('admin.%s.processo', $fluxo->id), ['etapa' => $fluxo_etapa]) }}"
                                                            @if ($fluxo_etapa->id == $etapa->id) class="border-indigo-500 text-indigo-600 whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm"    
                                                        @else
                                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200 whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm"> 
                                                        @endif
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

                    <table class="w-full table-auto">
                        <thead class="shadow-md rounded-t-sm">
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal rounded-t-md">
                                @if ($fluxo_etapa_items = data_get($etapa, 'fluxo_etapa_items'))
                                    @foreach ($fluxo_etapa_items as $fluxo_etapa_item)
                                        @if (data_get($fluxo_etapa_item, 'visible'))
                                            <th class="py-1 px-6 text-left  cursor-pointer">
                                                <div class="flex flex-col space-y-1">
                                                    <x-tall-table.sort
                                                        name="{{ data_get($fluxo_etapa_item, 'name') }}">
                                                        {{ __(data_get($fluxo_etapa_item, 'name')) }}
                                                    </x-tall-table.sort>
                                                </div>
                                            </th>
                                        @endif
                                    @endforeach
                                @endif
                                <th class="py-3 px-6 text-center">#</th>
                            </tr>
                        </thead>
                        @if ($models->count())
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach ($models as $model)
                                    @if ($produtos = data_get($model, 'produtos'))
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            @if ($fluxo_etapa_items = data_get($etapa, 'fluxo_etapa_items'))
                                                @foreach ($fluxo_etapa_items as $fluxo_etapa_item)
                                                    @if (data_get($fluxo_etapa_item, 'visible'))
                                                        @if ($name = data_get($fluxo_etapa_item, 'fluxo_field_id'))
                                                            <td class="py-3 px-6 text-left">
                                                                @if (data_get($fluxo_etapa_item, 'visible'))
                                                                    @if ($name = data_get($fluxo_etapa_item, 'fluxo_field_id'))
                                                                        @if (data_get($fluxo_etapa_item, 'fluxo_field.fluxo_field_db.model'))
                                                                            {{ data_get($fluxo_etapa_item, 'fluxo_field.fluxo_field_db.model') }}
                                                                        @elseif ($fluxo_field_options = data_get($fluxo_etapa_item, 'fluxo_field.fluxo_field_options'))
                                                                            @if ($fluxo_field_options->count())
                                                                                @if ($option = data_get($produtos, $name))
                                                                                    @foreach ($fluxo_field_options as $value)
                                                                                        @if ($option == data_get($value, 'id'))
                                                                                            {{ data_get($value, 'name') }}
                                                                                            {{ data_get($value, 'description') }}
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            @else
                                                                                {{ data_get($produtos, $name) }}
                                                                            @endif
                                                                        @else
                                                                            {{ data_get($produtos, $name) }}
                                                                        @endif
                                                                    @endif
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
                                    @endif
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
