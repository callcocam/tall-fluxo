<x-slot name="header">
    <x-tall-table.breadcrumbs url="{{ route($this->list) }}" label="{{ __('Fluxos') }}" />
    <x-tall-table.breadcrumbs url="#" label="{{ __('Listar') }}" />
</x-slot>
<div class="w-full">
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex   font-sans overflow-hidden">
            <div class="w-full">
                <div class="bg-white shadow-md rounded px-4">
                    <div class="sm:flex sm:items-center px-6 pt-6 pb-4">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">{{ __('Fluxos') }}</h1>
                            @isset($description)
                                <p class="mt-2 text-sm text-gray-700">{{ $description }}</p>
                            @endisset
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 flex items-center space-x-2">
                            <x-tall-table.filters.clear :filters="$filters" />
                            <x-tall-table.per-page :options="$optionsPerPage"/>
                            <x-tall-table.search />
                            <x-tall-table.add href="{{ route($this->create) }}">
                                {{ __('Adicionar Post') }}
                            </x-tall-table.add>
                        </div>
                    </div>
                    @include('tall::table.order')
                </div>
            </div>
        </div>
    </div>
</div>
