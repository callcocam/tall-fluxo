@if (class_exists('\Tall\Fluxo\Models\Fluxo'))
    @if (\Route::has('admin.fluxos.fields'))
        @can('admin.fluxos.fields')
            <div class="space-y-1">
                <a href="{{ route('admin.fluxos.fields') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                    <x-dynamic-component component="tall::icons.outline.template" class="mr-1 h-4 w-4 flex-shrink-0 " />
                    <span class="uppercase">
                        {{ __('CAMPOS') }}
                    </span>
                </a>
            </div>
        @endcan
    @endif
    @if (\Route::has('admin.fluxos'))
        @can('admin.fluxos')
            <div class="space-y-1">
                <a href="{{ route('admin.fluxos') }}"
                    class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                    <x-dynamic-component component="tall::icons.outline.puzzle" class="mr-1 h-4 w-4 flex-shrink-0 " />
                    <span class="uppercase">
                        {{ __('Fluxos') }}
                    </span>
                </a>
            </div>
        @endcan
    @endif
    @if ($fluxos = \Tall\Fluxo\Models\Fluxo::query()->whereStatus('published')->get())
        @foreach ($fluxos as $fluxo)
            @if ($fluxo_etapas = $fluxo->fluxo_etapas)
                @foreach ($fluxo_etapas as $fluxo_etapa)
                    @can(sprintf('admin.%s.processo.%s', $fluxo->route, $fluxo_etapa->route))
                        <div class="space-y-1">
                            <a href="{{ route(sprintf('admin.%s.processo.%s', $fluxo->route, $fluxo_etapa->route), ['path' => $fluxo_etapa->path]) }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                                <x-dynamic-component component="tall::icons.outline.plus"
                                    class="mr-1 h-4 w-4 flex-shrink-0 " />
                                <span class="uppercase">
                                    {{ $fluxo_etapa->name }}
                                </span>
                            </a>
                        </div>
                    @endcan
                @endforeach
            @endif
        @endforeach
    @endif
@endif
