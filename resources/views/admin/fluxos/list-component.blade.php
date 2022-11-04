<x-slot name="header">
    <x-tall-table.breadcrumbs url="{{ route($this->list) }}" label="{{ __('Fluxos') }}" />
    <x-tall-table.breadcrumbs url="#" label="{{ __('Listar') }}" />
</x-slot>
<x-tall-table.list
 title="Fluxos"
 routeCreate="{{ $this->create }}"
 routeOrder="{{ $this->order }}"
 :filters="$filters"
 >
    <table class="w-full table-auto">
        <thead class="shadow-md rounded-t-sm">
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal rounded-t-md">
                <th class="py-1 px-6 text-left  cursor-pointer">
                    <div class="flex flex-col space-y-1">
                        <x-tall-table.sort name="name">{{ __('Nome') }}</x-tall-table.sort>
                    </div>
                </th>
                <th class="py-1 px-6 text-left">
                    <x-tall-table.filters.status sort="1" />
                </th>
                <th class="py-3 px-6 text-center">#</th>
            </tr>
        </thead>
        @if ($models->count())
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($models as $model)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">
                            {{ $model->name }}
                        </td>
                        <td class="py-3 px-6 text-left">
                            <x-tall-table.status status="{{ $model->status }}" />
                        </td>
                        <td class="py-3 px-6 text-center">
                            <x-tall-table.actions :model="$model" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="w-full p-2 space-x-3">
                        {{ $models->links() }}
                    </td>
                </tr>
            </tfoot>
        @else
            <tr>
                <td colspan="3" class="w-full p-2 space-x-3">
                    <x-tall-table.empty />
                </td>
            </tr>
        @endif
    </table>
</x-tall-table.list>
