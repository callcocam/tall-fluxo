<div class="flex flex-col space-y-2 px-4">

    @if ($fields = $this->fields)
        <div>
            <h3 class="text-lg font-medium leading-6 text-gray-900">Selecione os Campos para
                o fluxo <b>{{ $model->name }}</b>
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $model->description }}</p>
        </div>
        <div class="mt-5 border-t border-gray-200">
            <x-errors />
            <dl class="divide-y divide-gray-200">
                @foreach ($fields as $key => $field)
                    <div class="py-1 sm:grid sm:grid-cols-3 sm:gap-4 ">
                        <dt class="text-sm font-medium text-gray-500">
                            <div class="relative flex items-start">
                                <div class="flex h-5 items-center">
                                    <input wire:model="selected.{{ $field->id }}" value="{{ $field->id }}"
                                        id="{{ $field->slug }}" aria-describedby="{{ $field->slug }}-description"
                                        name="{{ $field->slug }}" type="checkbox"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="{{ $field->slug }}"
                                        class="font-medium text-gray-700">{{ $field->name }}</label>
                                    @if ($description = $field->description)
                                        <p id="{{ $field->slug }}-description" class="text-gray-500 text-sm">
                                            {{ $description }}</p>
                                    @endif
                                </div>
                            </div>
                        </dt>
                        <dd class="mt-1 flex text-sm text-gray-900 sm:col-span-2 sm:mt-0 items-center">
                            <div class="flex items-center space-x-2">
                                @if (in_array($field->id, $selected))
                                    @if ($etapas = $model->fluxo_etapas)
                                        @foreach ($etapas as $key => $value)
                                            <div class="relative flex items-start">
                                                <div class="flex h-5 items-center">
                                                    <input
                                                        wire:model="selectedEtapa.{{ $field->id }}.{{ $value->id }}"
                                                        value="{{ $value->id }}"
                                                        id="{{ $field->id }}-{{ $value->slug }}"
                                                        aria-describedby="{{ $field->id }}-{{ $value->slug }}-description"
                                                        name="{{ $field->id }}-{{ $value->slug }}" type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                </div>
                                                <div class="ml-1 text-sm">
                                                    <label for="{{ $field->id }}-{{ $value->slug }}"
                                                        class="font-medium text-gray-700">{{ $value->name }} </label>
                                                    @if ($description = $value->description)
                                                        <p id="{{ $field->id }}-{{ $value->slug }}-description"
                                                            class="text-gray-500 text-sm">
                                                            {{ $description }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                            <span class="ml-4 flex-shrink-0">
                                @if (in_array($field->id, $selected))
                                    @if ($arrayFields = data_get($selectedEtapa, $field->id))
                                        @if (array_filter($arrayFields))
                                            <div class="flex items-center space-x-2">
                                                <button
                                                    wire:click="addField('{{ $field->id }}', '{{ $key }}')"
                                                    type="button"
                                                    class="rounded-md bg-white font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                    <x-tall-icon name="plus" class="h-5 w-5" />
                                                </button>
                                                <button wire:click="updateField('{{ $field->id }}')" type="button"
                                                    class="rounded-md bg-white font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                    <x-tall-icon name="pencil" class="h-5 w-5" />
                                                </button>
                                                <button wire:click="removeField('{{ $field->id }}')" type="button"
                                                    class="rounded-md bg-white font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                    <x-tall-icon name="trash" class="h-5 w-5" />
                                                </button>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </span>
                        </dd>
                    </div>
                    {{-- <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                        <input wire:model="selected.{{ $field->id }}" value="{{ $field->id }}"
                            id="{{ $field->slug }}" aria-describedby="{{ $field->slug }}-description"
                            name="{{ $field->slug }}" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="{{ $field->slug }}" class="font-medium text-gray-700">{{ $field->name }}</label>
                        @if ($description = $field->description)
                            <p id="{{ $field->slug }}-description" class="text-gray-500">
                                {{ $description }}</p>
                        @endif
                    </div>
                </div> --}}
                @endforeach
            </dl>
        </div>
    @endif
</div>
