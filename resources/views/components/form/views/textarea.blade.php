@props(['field'])
<div wire:key="{{ $field->slug }}" class="bg-gray-50 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6 items-center">
    <dt class="text-sm font-medium text-gray-500">{{ __($field->name) }}</dt>
    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
        <textarea {{ $attributes->merge($field->form_attributes()) }} ></textarea>
    </dd>
</div>
