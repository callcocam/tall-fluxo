<div class="w-full">
    <div class="bg-white shadow-md rounded px-2 ">
        <fieldset class="p-4  border rounded-md">
            <legend>Data base</legend>
            <form wire:submit.prevent="submit" class="flex items-center w-full space-x-2">
                <div class=" w-full">
                    <div class="mt-1">
                        <input title="Nome da connecção" type="text" wire:model.lazy='data.name'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Nome da connecção">
                    </div>
                </div>
                <div class=" w-full">
                    <div class="mt-1">
                        <select title="Tipo" type="text" wire:model.lazy='data.type'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Tipo">
                            @foreach (['hasOne', 'hasMany', 'belongsTo', 'belongsToMany'] as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class=" w-full">
                    <div class="mt-1">
                        <select title="Tipo" type="text" wire:model.lazy='data.model'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Tipo">
                            <option value="">Selecione</option>
                            @if ($models = $this->models)
                                @foreach ($models as $value)
                                    <option value="{{ data_get($value, 'id') }}">{{ data_get($value, 'name') }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class=" w-full">
                    <div class="mt-1">
                        <select title="Chave" type="text" wire:model.lazy='data.key_name'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Chave"> 
                            <option value="">Selecione</option>
                            @if ($columns)
                                @foreach ($columns as $name => $option)
                                    @if (is_array($option))
                                        <optgroup label="{{ __($name) }}">
                                            @foreach ($option as $group)
                                                <option value="{{ $name }}.{{ $group }}">
                                                    {{ $group }}</option>
                                            @endforeach
                                        </optgroup>
                                    @else
                                        <option value="{{ $name }}">{{ $option }}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div><div class=" w-full">
                    <div class="mt-1">
                        <select title="Coluna(s)" type="text" wire:model.lazy='data.columns'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Coluna(s)">
                            <option value="">Selecione</option>
                            @if ($columns)
                                @foreach ($columns as $name => $option)
                                    @if (is_array($option))
                                        <optgroup label="{{ __($name) }}">
                                            @foreach ($option as $group)
                                                <option value="{{ $name }}.{{ $group }}">
                                                    {{ $group }}</option>
                                            @endforeach
                                        </optgroup>
                                    @else
                                        <option value="{{ $name }}">{{ $option }}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class=" w-48 flex items-center justify-center">
                    <button>
                        <x-tall-icon name="pencil" class="h-6 w-6" />
                    </button>
                </div>
            </form>
        </fieldset>
    </div>
</div>
