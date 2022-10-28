<div class="w-full">
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex  font-sans overflow-hidden">
            <div class="w-full">
                <div class="bg-white shadow-md rounded">
                    <form wire:submit.prevent="submit" class="flex items-center p-3 border rounded-md w-full space-x-2">
                        <div class=" w-full">
                            <div class="mt-1">
                                <input title="Nome da etapa" type="text" wire:model.lazy='data.fluxo_etapas.name'
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Nome da etapa">
                            </div>
                        </div>
                        <div class=" w-full">
                            <div class="mt-1">
                                <input title="Rota para acessar a etapa" type="text"
                                    wire:model.lazy='data.fluxo_etapas.route'
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Rota para acessar a etapa">
                            </div>
                        </div>
                        <div class=" w-full">
                            <div class="mt-1">
                                <input title="Url para acessar a etapa ex:fonecedor" type="text"
                                    wire:model.lazy='data.fluxo_etapas.path'
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Url para acessar a etapa ex:fonecedor">
                            </div>
                        </div>
                        <div>
                            <div class="mt-1">
                                <input title="Ordem" type="text" wire:model.lazy='data.fluxo_etapas.ordering'
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="00">
                            </div>
                        </div>
                        <div class=" w-48 flex items-center justify-center">
                            <button>
                                <x-tall-icon name="plus" class="h-6 w-6" />
                            </button>
                        </div>
                    </form>
                    @if ($fluxo_etapas = $model->fluxo_etapas)
                        @foreach ($fluxo_etapas as $fluxo_etapa)
                            <fieldset class="mb-4 p-2">
                                <legend class="text-xl">Etapa - {{ $fluxo_etapa->name }} -
                                    {{ str_pad($fluxo_etapa->ordering, 2, '0', STR_PAD_LEFT) }}</legend>
                                @livewire('tall::admin.fluxo.etapas.edit-component', ['model' => $fluxo_etapa], key($fluxo_etapa->id))
                            </fieldset>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
