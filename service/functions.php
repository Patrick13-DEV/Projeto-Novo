<?php
/** Presentation-independent formatting helpers for appointment history. */
function escapar($valor)
{
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}
function statusTexto($status)
{
    $statusNomes = [
        'pendente' => 'Pendente',
        'confirmado' => 'Confirmado',
        'concluido' => 'Concluído',
        'cancelado' => 'Cancelado'
    ];

    return $statusNomes[$status] ?? ucfirst((string) $status);
}
function statusClasse($status)
{
    switch ($status) {
        case 'confirmado':
            return 'bg-emerald-100 text-emerald-700';

        case 'concluido':
            return 'bg-blue-100 text-blue-700';

        case 'cancelado':
            return 'bg-red-100 text-red-700';

        default:
            return 'bg-amber-100 text-amber-700';
    }
}

