<?php

namespace AdminKit\Vacancy\UI\Filament\Resources\VacancyResource\Pages;

use AdminKit\Vacancy\UI\Filament\Resources\VacancyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVacancy extends CreateRecord
{
    protected static string $resource = VacancyResource::class;

    protected static bool $canCreateAnother = false;
}
