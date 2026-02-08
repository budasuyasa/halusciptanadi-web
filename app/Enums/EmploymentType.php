<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum EmploymentType: string implements HasColor, HasLabel
{
    case FullTime = 'full_time';
    case PartTime = 'part_time';
    case Contract = 'contract';
    case Internship = 'internship';

    public function getLabel(): string
    {
        return match ($this) {
            self::FullTime => 'Full Time',
            self::PartTime => 'Part Time',
            self::Contract => 'Kontrak',
            self::Internship => 'Magang',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::FullTime => 'success',
            self::PartTime => 'info',
            self::Contract => 'warning',
            self::Internship => 'primary',
        };
    }
}
