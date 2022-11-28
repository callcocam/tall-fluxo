<div class="w-full">
    <label for="{{ $validateName }}-validations"
        class="block text-sm font-medium text-gray-700">{{ data_get($option, 'label') }}</label>
    <div class="mt-1 flex">
        <div class="flex-1">
            @if (data_get($option, 'params'))
                <input type="text" name="{{ $validateName }}" id="{{ $validateName }}-validations"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    wire:model.defer="data.fluxo_field_validations.description"
                    placeholder="{{ data_get($option, 'label') }}" aria-describedby="{{ $validateName }}-validations" />
            @endif
        </div>
        <div class=" flex items-center justify-center">
            @if ($modelValidation)
                <button type="button" wire:click="editValidation">
                    <x-tall-icon name="pencil" class="h-6 w-6" />
                </button>
                <button type="button" wire:click="removeValidation">
                    <x-tall-icon name="trash" class="h-6 w-6" />
                </button>
            @else
                <button type="button" wire:click="addValidation">
                    <x-tall-icon name="plus" class="h-6 w-6" />
                </button>
            @endif
        </div>
    </div>
    @if ($help = data_get($option, 'help'))
        <p class="mt-2 text-sm text-gray-500" id="email-description">{!! $help !!}</p>
    @endif
</div>
