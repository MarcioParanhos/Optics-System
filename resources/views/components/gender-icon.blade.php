@props(['category'])

{{-- Apenas renderiza o badge se for uma das categorias com ícone --}}
@if (in_array($category, ['Feminino', 'Masculino', 'Unissex']))

    {{-- Usamos a diretiva @class para aplicar classes de forma limpa e condicional --}}
    <span
        :title="$category"
        @class([
            'badge', // Classe base do Tabler para badges
            'p-1',   // Padding para criar o efeito de quadrado
            'bg-blue-lt' => $category === 'Masculino',  // Cor azul clara do Tabler
            'bg-pink-lt' => $category === 'Feminino',   // Cor rosa clara do Tabler
            'bg-secondary-lt' => $category === 'Unissex', // Cor neutra do Tabler
        ])
    >
        @if ($category === 'Feminino')
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-gender-female text-pink">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 9m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                <path d="M12 14v7" />
                <path d="M9 18h6" />
            </svg>
        @elseif ($category === 'Masculino')
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-gender-male text-blue">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 14m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                <path d="M19 5l-5.4 5.4" />
                <path d="M19 5h-5" />
                <path d="M19 5v5" />
            </svg>
        @elseif ($category === 'Unissex')
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gender-agender text-secondary" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 12m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0"></path>
                <path d="M7 12h11"></path>
            </svg>
        @endif
    </span>

@else
    {{-- Caso contrário, exibe a categoria como texto simples --}}
    {{ $category }}
@endif