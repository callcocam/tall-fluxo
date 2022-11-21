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
                            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $model->name }}</h3>
                            {{-- <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p> --}}
                        </div>
                        <div class="border-t border-gray-200">
                            <fieldset class="flex flex-col space-y-2 px-2">
                                <legend class=" py-1">Selecione os Campos para o fluxo <b>{{ $model->name }}</b></legend>
                                @if ($fields = $this->fields)
                                    <div class="px-5">
                                        @foreach ($fields as $field)
                                            <div class="relative flex items-start">
                                                <div class="flex h-5 items-center">
                                                    <input wire:model="selected.{{ $field->id }}" value="{{ $field->id }}" id="{{ $field->slug }}"
                                                        aria-describedby="{{ $field->slug }}-description"
                                                        name="{{ $field->slug }}" type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="{{ $field->slug }}"
                                                        class="font-medium text-gray-700">{{ $field->name }}</label>
                                                    @if ($description = $field->description)
                                                        <p id="{{ $field->slug }}-description" class="text-gray-500">
                                                            {{ $description }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </fieldset>

                            @livewire('tall::admin.fluxo.etapas.create-component', ['model' => $model], key($model->id))
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
