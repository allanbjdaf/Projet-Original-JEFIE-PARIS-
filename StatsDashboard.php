<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Inscriptions Totales', User::count())
                ->description('Utilisateurs enregistrés sur le site')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
                
            Stat::make('Entreprises Partenaires', User::where('role', 'entreprise')->count())
                ->description('Comptes professionnels actifs')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('warning'),
        ];
    }
}
