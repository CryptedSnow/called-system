<?php

namespace App\Enum;

enum GravidadeChamadoEnum: string
{
    case BAIXA = 'Baixa';
    case MEDIA = 'Média';
    case ALTA = 'Alta';
    case CRITICA = 'Crítica';
    case EMERGENCIAL = 'Emergencial';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->value])
            ->toArray();
    }
}
