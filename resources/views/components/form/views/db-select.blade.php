@props(['field'])
<div wire:key="{{ $field->slug }}" class="col-span-12 md:col-span-{{ $field->width }}">
    <label class="block" for="{{ $field->name }}">
        <span> {{ __($field->label) }}</span>
        <select {{ $attributes->merge($field->form_attributes) }}>
            @if ($options = $field->form_db_options)
                @foreach ($options as $name => $option)
                    <option value="{{ $name }}">{{ $option }}</option>
                @endforeach
            @endif
        </select>
    </label>
</div>
