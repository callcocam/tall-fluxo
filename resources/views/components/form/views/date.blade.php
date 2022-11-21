@props(['field'])
<div wire:key="{{ $field->slug }}" class="col-span-12 md:col-span-{{ $field->width }}">
    <label class="block" for="{{ $field->name }}">
        <span> {{ __($field->name) }}</span>
        <input {{ $attributes->merge($field->form_attributes) }} />
    </label>
</div>
