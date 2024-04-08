<?php

namespace AdminKit\Vacancy\UI\Filament\Resources\VacancyResource\Pages;

use AdminKit\Vacancy\UI\Filament\Resources\VacancyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVacancy extends EditRecord
{
    protected static string $resource = VacancyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successRedirectUrl(VacancyResource::getUrl()),
        ];
    }
}
