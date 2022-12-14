<div class="w-full ">
    <div class="bg-white  rounded">
        <form wire:submit.prevent="submit" class="flex items-center p-3 w-full space-x-2">
            <div class="w-full">
                <div class="mt-1">
                    <input title="Nome da opção" type="text" wire:model.lazy='data.name'
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Nome da opção">
                </div>
            </div>
            <div class=" w-full">
                <div class="mt-1">
                    <input title="Valor da opção" type="text" wire:model.lazy='data.description'
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Valor da opção">
                </div>
            </div>
            <div>
                <div class="mt-1">
                    <input title="Ordem da opção" type="text" wire:model.lazy='data.ordering'
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Ordem da opção">
                </div>
            </div>
            <div class=" w-50 flex items-center space-x-1">
                <button class="p-1">
                    <x-tall-icon name="pencil" class="h-6 w-6" />
                </button>
                <button type="button" class="p-1" wire:click='delete'>
                    <x-tall-icon name="trash" class="h-6 w-6" />
                </button>
            </div>
        </form>
    </div>
</div>
