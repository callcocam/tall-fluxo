@props(['field'])
    <div wire:key="{{ $field->slug }}">
        <label class="block" for="{{ $field->name }}">
            <span> {{ __($field->label) }} </span>
            <input onKeyUp="mascaraMoeda(this, event)" {{ $attributes->merge($field->form_attributes) }} />
            <p class="mt-2 text-xs text-gray-500" id="email-description">{{ $field->description}}</p>
        </label>
    </div>
<script>
    String.prototype.reverse = function(){
        return this.split('').reverse().join('');
    };

    function mascaraMoeda(campo,evento){
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
        var resultado  = "";
        var mascara = "##.###.###,##".reverse();
        for (var x=0, y=0; x<mascara.length && y<valor.length;) {
            if (mascara.charAt(x) != '#') {
                resultado += mascara.charAt(x);
                x++;
            } else {
                resultado += valor.charAt(y);
                y++;
                x++;
            }
        }
        campo.value = resultado.reverse();
    }
</script>
