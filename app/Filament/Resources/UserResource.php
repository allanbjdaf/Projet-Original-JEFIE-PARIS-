<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    // Icône du menu (Design épuré Heroicons)
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Inscriptions & Utilisateurs';
    protected static ?string $modelLabel = 'Inscrit';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Organisation en carte moderne
                Forms\Components\Section::make('Informations du profil')
                    ->description('Gérez les coordonnées essentielles de l\'utilisateur.')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom complet')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Adresse e-mail')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('role')
                            ->label('Rôle d\'accès')
                            ->required()
                            ->options([
                                'participant' => 'Participant',
                                'candidat' => 'Candidat',
                                'entreprise' => 'Entreprise',
                                'admin' => 'Administrateur',
                                'super_admin' => 'Super Admin',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->copyable() // Permet de copier l'email d'un clic
                    ->icon('heroicon-m-envelope'),
                Tables\Columns\TextColumn::make('role')
                    ->label('Statut / Rôle')
                    ->badge() // Transforme le texte en badge de couleur épuré
                    ->color(fn (string $state): string => match ($state) {
                        'super_admin' => 'danger',
                        'admin' => 'warning',
                        'entreprise' => 'purple',
                        'candidat' => 'info',
                        default => 'success',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date d\'inscription')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                // Permet de filtrer en un clic par rôle
                Tables\Filters\SelectFilter::make('role')
                    ->label('Filtrer par rôle')
                    ->options([
                        'participant' => 'Participants',
                        'entreprise' => 'Entreprises',
                        'admin' => 'Administrateurs',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
