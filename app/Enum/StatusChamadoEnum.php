<?php

namespace App\Enum;

enum StatusChamadoEnum: string
{
    case ANDAMENTO = 'Andamento';
    case CONCLUIDO = 'Concluído';

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
