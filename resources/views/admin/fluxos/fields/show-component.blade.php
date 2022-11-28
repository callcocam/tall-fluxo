<div class="w-full">
    <div class="bg-white shadow-md rounded">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $model->name }} {{ $model->view }}</h3>
                {{-- <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p> --}}
            </div>
            <div class="border-t border-gray-200">
                @livewire('tall::admin.fluxos.fields.attributes.create-component', ['model' => $model], key(sprintf('%s-attributes', $model->id)))
                @if (in_array($model->view, ['select', 'radio', 'checkbox']))
                    @livewire('tall::admin.fluxos.fields.options.create-component', ['model' => $model], key(sprintf('%s-options', $model->id)))
                @endif
                @if (in_array($model->view, ['db', 'db-select', 'db-radio', 'db-checkbox']))
                    @if ($fluxo_field_db = $model->fluxo_field_db()->where('fluxo_field_id', $model->id)->first())
                        @livewire(
                            'tall::admin.fluxos.fields.db.edit-component',
                            [
                                'model' => $fluxo_field_db,
                            ],
                            key(sprintf('%s-db', $model->id)),
                        )
                    @else
                        @livewire(
                            'tall::admin.fluxos.fields.db.edit-component',
                            [
                                'model' => $model->fluxo_field_db()->create([
                                    'fluxo_field_id' => $model->id,
                                ]),
                            ],
                            key(sprintf('%s-db', $model->id)),
                        )
                    @endif

                @endif
            </div>
            @livewire('tall::admin.fluxos.fields.validations.create-component', ['model' => $model], key(sprintf('%s-attributes', $model->id)))
              
        </div>
    </div>
</div>
