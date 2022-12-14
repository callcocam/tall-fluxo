@props(['field'])
<div wire:key="{{ $field->slug }}">
    <label class="block"  for="{{ $field->name }}">
        <span> {{ __($field->label) }} </span>
        <input {{ $attributes->merge($field->form_attributes) }} />
        <p class="mt-2 text-xs text-gray-500">{{ $field->description }}</p>
       <x-tall-form.input-error for="data.{{$field->fluxo_field_id}}" />
    </label>
</div>
