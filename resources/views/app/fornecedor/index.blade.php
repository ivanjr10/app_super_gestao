<h3>fornecedor2</h3>

@php

@endphp


{{-- @if(count($fornecedores) > 0 && count($fornecedores) < 10)
    <h3>Existem Alguns fornecedores cadastrados </h3>
    
@elseif(count($fornecedores) > 10)
    <h3>Existem Varios fornecedores cadastrados </h3>
@else
    <h3>Ainda nao existem fornecedores cadastrados </h3>

@endif --}}

Fornedor: {{ $fornecedores[0]['nome']   }}
<br>
Status: {{  $fornecedores[0]['status'   ]}}

@unless($fornecedores[0]['status'] == 'S') <!-- Se o retorno for false -->
    Fornecedor inativo
@endunless
<br>
