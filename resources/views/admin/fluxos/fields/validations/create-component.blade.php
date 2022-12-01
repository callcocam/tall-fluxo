<div class="w-full">
    <div class="bg-white shadow-md rounded p-3">
        <fieldset class="p-4  border rounded-md">
            <legend>Available Validation Rules</legend>
            @if ($options = $this->options)
                @foreach ($options as $name => $option)
                    @if (data_get($option, 'visible'))
                        @livewire('tall::admin.fluxos.fields.validations.edit-component', ['model' => $model,'validateName'=>$name, 'option'=>$option], key($name))
                    @endif
                @endforeach
            @endif
        </fieldset>
    </div>
</div>
