<x-slot name="header">
    <x-tall-table.breadcrumbs url="{{ route($this->list, $etapa) }}" label="{{ __('Fluxo') }}" />
    <x-tall-table.breadcrumbs url="#" label="{{ $title }}" />
</x-slot>
<div class="w-full">
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex  font-sans overflow-hidden">
            <div class="w-full">
                <div class="bg-white shadow-md rounded">
                    <form wire:submit.prevent="submit" class="border-t border-gray-200">
                        <x-errors />
                        <div class="grid grid-cols-12 p-5 gap-2">
                            @if ($fluxo_etapa_items = $this->fluxo_etapa_items)
                                @foreach ($fluxo_etapa_items as $field)
                                    @if ($field->visible)
                                        <div
                                            class="col-span-{{ $field->width }} p-2 bg-gray-50 rounded-md form-edicao-produtos">
                                        <x-dynamic-component
                                            component="{{ sprintf('tall-form.views.%s', data_get($field->fluxo_field, 'view', 'text')) }}"
                                            :field="$field" />
                                        </div>
                                    @endif
                                @endforeach
                            @endif
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
    <style>
        .form-edicao-produtos input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-edicao-produtos input:focus {
            border: 1px solid #5c88f3 !important;
        }

        .form-edicao-produtos select {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</div>
