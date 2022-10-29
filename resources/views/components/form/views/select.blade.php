@props(['field'])
<div wire:key="{{ $field->slug }}" class="bg-gray-50 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6 items-center">
    <dt class="text-sm font-medium text-gray-500">{{ __($field->name) }}</dt>
    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
        <select {{ $attributes->merge($field->form_attributes($field)) }}>
            @if ($options = $field->form_options())
                @foreach ($options as $option)
                    <option value="{{ data_get($option, 'id') }}">
                        {{  sprintf("%s %s", data_get($option, 'name'), data_get($option, 'description')) }}
                    </option>
                @endforeach
            @endif
        </select>
    </dd>
</div>
