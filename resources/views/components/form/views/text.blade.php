@props(['field'])
<div wire:key="{{ $field->slug }}" class="col-span-12 md:col-span-{{ $field->width }}">
    <label class="block" for="{{ $field->name }}">
        <span> {{ __($field->label) }}</span>
        <input {{ $attributes->merge($field->form_attributes) }} />
        @if ($field->description)
            <p class="text-xs">{{ __($field->description) }}</p>
        @endif
    </label>
</div>
