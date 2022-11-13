<div class="w-full ">
    <div class="bg-white  rounded">
        <form wire:submit.prevent="submit" class="flex items-center p-3 w-full space-x-2">
            <div class=" w-full">
                <div class="mt-1">
                    <input title="Nome da etapa" type="text" wire:model.lazy='data.name'
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Nome da etapa">
                </div>
            </div>
            <div class=" w-full">
                <div class="mt-1">
                    <input title="Nome da rota da etapa  ex:fonecedor" type="text" wire:model.lazy='data.route'
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Rota para acessar a etapa ex:fonecedor">
                </div>
            </div>
            <div class=" w-full">
                <div class="mt-1">
                    <input title="Url para acessar a etapa ex:fonecedor" type="text" wire:model.lazy='data.path'
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Url para acessar a etapa ex:fonecedor">
                </div>
            </div>
            <div>
                <div class="mt-1">
                    <input title="Ordem" type="text" wire:model.lazy='data.ordering'
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="00">
                </div>
            </div>
            <div class=" w-50 flex items-center space-x-1">
                <button class="p-1">
                    <x-tall-icon name="pencil" class="h-6 w-6" />
                </button>
                <button type="button" class="p-1" wire:click='delete'>
                    <x-tall-icon name="trash" class="h-6 w-6" />
                </button>
                <a target="__blank" href="{{ route(sprintf("admin.%s.processo", $model->fluxo->id), $model) }}">
                    <x-tall-icon name="eye" class="h-6 w-6" />
                </a>
            </div>
        </form>
        @livewire('tall::admin.fluxo.etapas.items.create-component', ['model' => $model], key(uniqId($model->id)))
    </div>
</div>
