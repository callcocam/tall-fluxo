@props([ 'group' => 'group'])
<div {{ $attributes }} x-data="{ active: true, handler: true }" x-init="Sortablejs.create($el, {
    animation: 200,
    easing: 'cubic-bezier(0, 0, 0.2, 1)',
    group: '{{ $group }}',
    delay: 150,
    delayOnTouchOnly: true,
    draggable: '.draggable',
    handle: '.draggable-handler',
    store: {
        get: function(sortable) {
            var order = $wire.geGroupUpdatedOrder();
            order.then(d => {
                {{-- console.log(d, sortable.options.group.name) --}}
            });
            return [];
        },
        set: function(sortable) {
            var order = sortable.toArray(); 
            $wire.setGroupUpdatedOrder(order.join('|'));
        }
    }
})">
    {{ $slot }}
</div>
