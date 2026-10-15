<?php
/** Date formatting for display in appointment cards. */
function dataHoraAgendamento(string $valor): array
{
    $data = new DateTime($valor);
    return [$data->format('d/m/Y'), $data->format('H:i')];
}
function dataCompletaAgendamento(string $valor, array $diasSemana): array
{
    $data = new DateTime($valor);
    return [$diasSemana[$data->format('l')], $data->format('d/m/Y'), $data->format('H:i')];
}
