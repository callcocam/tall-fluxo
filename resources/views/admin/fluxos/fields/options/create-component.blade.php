<div class="w-full">
    <div class="bg-white shadow-md rounded p-3">
        <fieldset class="p-4  border rounded-md">
            <legend>Options</legend>
            <form wire:submit.prevent="submit" class="flex items-center w-full space-x-2">
                <div class="w-full">
                    <div class="mt-1">
                        <input title="Nome da opção" type="text" wire:model.lazy='data.fluxo_field_options.name'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Nome da opção">
                    </div>
                </div>
                <div class="w-full">
                    <div class="mt-1">
                        <input title="Valor da opção" type="text"
                            wire:model.lazy='data.fluxo_field_options.description'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Valor da opção">
                    </div>
                </div>
                <div>
                    <div class="mt-1">
                        <input title="Ordem da opção" type="text"
                            wire:model.lazy='data.fluxo_field_options.ordering'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Ordem da opção">
                    </div>
                </div>
                <div class=" w-48 flex items-center justify-center">
                    <button>
                        <x-tall-icon name="plus" class="h-6 w-6" />
                    </button>
                </div>
            </form>
            @if ($fluxo_field_options = $model->fluxo_field_options)
                @foreach ($fluxo_field_options as $fluxo_field_option)
                    @livewire('tall::admin.fluxos.fields.options.edit-component', ['model' => $fluxo_field_option], key($fluxo_field_option->id))
                @endforeach
            @endif
        </fieldset>
    </div>
</div>
