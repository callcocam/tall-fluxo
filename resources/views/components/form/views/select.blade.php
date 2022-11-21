@props(['field'])
<div wire:key="{{ $field->slug }}" class="col-span-12 md:col-span-{{ $field->width }}">
    <label class="block" for="{{ $field->name }}">
        <span> {{ __($field->name) }}</span>
        <select {{ $attributes->merge($field->form_attributes) }}>
            @if ($options = $field->form_options)
                @foreach ($options as $option)
                    <option value="{{ data_get($option, 'id') }}">
                        {{ sprintf('%s %s', data_get($option, 'name'), data_get($option, 'description')) }}
                    </option>
                @endforeach
            @endif
        </select>
    </label>
</div>
