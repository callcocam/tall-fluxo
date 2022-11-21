@props(['field'])
<div wire:key="{{ $field->slug }}" class="bg-gray-50 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6 items-center">
    <label class="block" for="{{ $field->name }}">
        <span> {{ __($field->name) }}</span>
        <textarea {{ $attributes->merge($field->form_attributes) }} ></textarea>
    </label>
</div>
