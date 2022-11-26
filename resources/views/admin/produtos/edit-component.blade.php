<x-slot name="header">
    <x-tall-table.breadcrumbs url="{{ route($this->list) }}" label="{{ __('Fluxo') }}" />
    <x-tall-table.breadcrumbs url="#" label="{{ $title }}" />
</x-slot>
<div class="w-full">
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex  font-sans overflow-hidden">
            <div class="w-full">
                <div class="bg-white shadow-md rounded">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{ $model->nome_produto }}</h3>
                        </div>
                        @if ($fluxo_etapa_items = $this->fluxo_etapa_items)
                            @foreach ($fluxo_etapa_items as $field)
                                @if ($field->visible)
                                    <div class="col-span-{{ $field->width }} p-2 bg-gray-100 rounded-md">
                                        @if ($fluxo_field = $field->fluxo_field)
                                            <x-dynamic-component
                                                component="{{ sprintf('tall-form.views.%s', data_get($fluxo_field, 'view', 'text')) }}"
                                                :field="$field" />
                                        @else
                                            <x-dynamic-component
                                                component="{{ sprintf('tall-form.views.%s', data_get($field, 'view', 'text')) }}"
                                                :field="$field" />
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
