<div class="w-full">
    <div class="bg-white shadow-md rounded p-3">
        <fieldset class="px-4 border rounded-md flex flex-col">
            <legend>Attributos</legend>
            <form wire:submit.prevent="submit"
                class="flex items-center w-full space-x-2 mb-1">
                <div>
                    <div class="mt-1">
                        <input title="Nome do attributo" type="text"
                            wire:model.lazy='data.fluxo_field_attributes.name'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Nome do attributo">
                    </div>
                </div>
                <div class=" w-full">
                    <div class="mt-1">
                        <input title="Valor do attributo" type="text"
                            wire:model.lazy='data.fluxo_field_attributes.description'
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Valor do attributo">
                    </div>
                </div>
                <div class=" w-48 flex items-center justify-center">
                    <button>
                        <x-tall-icon name="plus" class="h-6 w-6" />
                    </button>
                </div>
            </form>
            @if ($fluxo_field_attributes = $model->fluxo_field_attributes)
                @foreach ($fluxo_field_attributes as $fluxo_field_attribute)
                    <fieldset class=" py-2 ">
                        <legend class="text-xl">Attributos</legend>
                        @livewire('tall::admin.fluxos.fields.attributes.edit-component', ['model' => $fluxo_field_attribute], key($fluxo_field_attribute->id))
                    </fieldset>
                @endforeach
            @endif
        </fieldset>
    </div>
</div>