<x-slot name="header">
    <x-tall-table.breadcrumbs url="{{ route($this->list, $etapa) }}" label="{{ __('Post') }}" />
    <x-tall-table.breadcrumbs url="#" label="{{ $title }}" />
</x-slot>
<div class="w-full">
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex  font-sans overflow-hidden">
            <div class="w-full">
                <div class="bg-white shadow-md rounded">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    @if ($confirm)
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-red-500"> A conta <b
                                        class="text-xl">{{ $model->name }}</b>
                                    será excluída em {{ $confirm }}, todos os recursos e dados
                                    serão excluídos.
                                </h3>
                                <p wire:poll.1000ms="kill('{{route($this->list, $etapa) }}')"
                                    class="mt-1 max-w-2xl text-sm text-gray-800 font-bold">
                                    <x-button squared indigo wire:click="kill('{{route($this->list, $etapa) }}')"
                                        label="{{ sprintf('Confirmar e Voltar para a lista em %s ...', $confirm) }}" />
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900"> Depois que a conta <b
                                        class="text-xl">{{ $model->name }}</b> for excluída, todos os recursos e dados
                                    serão excluídos.
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Antes de excluir a conta <b class="text-xl">{{ $model->name }}</b>, faça o download
                                    de quaisquer dados ou
                                    informações que deseja reter.</p>
                            </div>
                            <div class="border-t border-gray-200">
                                <div class="bg-white px-4 py-5">
                                    @isset($viewDelete)
                                        @includeIf($viewDelete, ['model' => $model])
                                    @endisset
                                    @if ($relations = $this->relations)
                                        @foreach ($relations as $relation)
                                            @if ($result = data_get($model, $relation))
                                                <div
                                                    class="bg-gray-50 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        Foram encontrados
                                                        <b> {{ $result->count() }}</b> sub menus relacionado a este menu
                                                    </dt>
                                                </div>
                                                @foreach ($result as $name => $item)
                                                    <div
                                                        class="bg-gray-50 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                                        <dt class="text-sm font-medium text-gray-500">
                                                            {{ data_get($item, 'name') }}</dt>
                                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                            <x-button red label="{{ __('Excluir') }}" />
                                                        </dd>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                    <dt class="text-sm font-medium text-gray-500">
                                        Tem certeza de que deseja excluir a conta <b
                                            class="text-xl">{{ $model->name }}</b> ?
                                        @if (!$security)
                                            <br> Digite sua
                                            senha
                                            para confirmar que deseja excluir a conta.
                                        @endif
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                            <li class="pl-3 pr-4 py-3 flex items-center justify-between ">
                                                <div class="  flex items-center space-x-3 ">
                                                    @if (!$security)
                                                        <x-input right-icon="eye" placeholder="*****"
                                                            wire:model="password" type="password" />
                                                        @if ($valid)
                                                            <x-toggle value="1" lg
                                                                label="{{ __('Usar essa senha em operações futuras') }}"
                                                                wire:model="security" />
                                                        @endif
                                                    @else
                                                        <x-toggle value="1" lg
                                                            label="{{ __('O modo de cofiabilidade esta ativo até') }}"
                                                            wire:model="security" />
                                                        <b>{{ date_carbom_format(auth()->user()->security)->format('d/m/Y H:i:s') }}</b>
                                                    @endif

                                                </div>
                                                <div class="ml-4 flex items-center space-x-2">
                                                    <x-button wire:click="remove" label="{{ __('Excluir cadastro') }}"
                                                        icon="trash" red squared />
                                                    <x-button icon="arrow-left" squared indigo
                                                        href="{{ route($this->list, $etapa) }}"
                                                        label="{{ __('Voltar para a lista') }}" />
                                                </div>
                                            </li>
                                        </ul>
                                    </dd>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
