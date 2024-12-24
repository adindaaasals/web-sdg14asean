<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MapsResource\Pages;
use App\Filament\Resources\MapsResource\RelationManagers;
use App\Models\Maps;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MapsResource extends Resource
{
    protected static ?string $model = Maps::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Countries Coordinates';
    protected static ?int $navigationSort = 2; // Urutan menu

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('country_name')->required(),
                Forms\Components\TextInput::make('country_code')->required(),
                Forms\Components\TextInput::make('geojson')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country_name'),
                Tables\Columns\TextColumn::make('country_code'),
                Tables\Columns\TextColumn::make('geojson'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaps::route('/'),
            'create' => Pages\CreateMaps::route('/create'),
            'edit' => Pages\EditMaps::route('/{record}/edit'),
        ];
    }
}
