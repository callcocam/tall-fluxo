<x-slot name="header">
    <x-tall-table.breadcrumbs url="{{ route($this->list) }}" label="{{ __('Produtos') }}" />
    <x-tall-table.breadcrumbs url="#" label="{{ $title }}" />
</x-slot>
<div class="w-full">
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex  font-sans overflow-hidden">
            <div class="w-full">
                <div class="bg-white shadow-md rounded">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $model->nome_produto }}</h3>
                        </div>
{{--                        @dd($model->produtos)--}}

                        <div class="border-t border-gray-200">
                           Nome do Produto: {{$model->nome_produto}}<br/>
                           Código de barras: {{$model->cod_barras}}
                            @if ($fluxo_etapa_items = $this->fluxo_etapa_items)
                                @foreach ($fluxo_etapa_items as $field)
                                    @if ($field->visible)
                                        <div
                                            class="col-span-{{ $field->width }} p-2 bg-gray-50 rounded-md form-edicao-produtos">
                                            @if ($fluxo_field = $field->fluxo_field)
                                                {{$field->name}}  : {{data_get($model->produtos, $field->fluxo_field_id)}}
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
