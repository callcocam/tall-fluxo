<x-slot name="header">
    <x-tall-table.breadcrumbs url="{{ route($this->list) }}" label="{{ __('Fluxo') }}" />
    <x-tall-table.breadcrumbs url="#" label="{{ $title }}" />
</x-slot>
<div class="w-full">
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex  font-sans overflow-hidden">
            <div class="w-full">
                <div class="bg-white shadow-md rounded">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{ $model->name }}</h3>
                        </div>
                        @livewire('tall::admin.fluxo.fields.show-component', compact('model'))

                        <form wire:submit.prevent="submit" class="border-t border-gray-200 mt-4">
                            <x-errors />
                            <dl>

                                @if ($types = $this->types)
                                    @foreach ($types as $name => $field)
                                        @if ($field->condition)
                                            @if (!in_array($name, $this->ignores))
                                                @if (in_array($name, array_keys($data)))
                                                    {{ $field->render()->with('data', $data)->with('field', $name)->with('model', $model) }}
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </dl>
                            <div class="bg-white px-4 py-5 flex justify-between sm:px-6">
                                @if ($list = $this->list)
                                    <x-button red squared href="{{ route($list) }}" icon="arrow-narrow-left"
                                              label="{{ __('Voltar para a lista') }}" primary />
                                @endif
                                <x-button icon="save" indigo squared type="submit"
                                          label="{{ __('Salvar alterações') }}" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
