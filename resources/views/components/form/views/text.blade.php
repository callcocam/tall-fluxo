@props(['field'])
<div wire:key="{{ $field->slug }}">
    <label class="block" for="{{ $field->name }}">
        <span> {{ __($field->label) }} </span>
        <input {{ $attributes->merge($field->form_attributes) }} />
        <p class="mt-2 text-xs text-gray-500" id="email-description">{{ $field->description}}</p>
    </label>
</div>
