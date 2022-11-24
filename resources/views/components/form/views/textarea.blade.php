@props(['field'])
<div wire:key="{{ $field->slug }}" class="col-span-12 md:col-span-{{ $field->width }}">
    <label class="block" for="{{ $field->name }}">
        <span> {{ __($field->label) }}</span>
        <textarea {{ $attributes->merge($field->form_attributes) }}></textarea>
        @if ($field->description)
            <p class="text-xs font-bold">{{ __($field->description) }}</p>
        @endif
    </label>
</div>
