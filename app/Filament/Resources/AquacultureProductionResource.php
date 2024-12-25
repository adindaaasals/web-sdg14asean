<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AquacultureProductionResource\Pages;
use App\Filament\Resources\AquacultureProductionResource\RelationManagers;
use App\Models\AquacultureProduction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AquacultureProductionResource extends Resource
{
    protected static ?string $model = AquacultureProduction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Key Focus Area of SDG 14';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('country_code')->label('Country Code')->required(),
                Forms\Components\TextInput::make('country_name')->label('Country Name')->required(),
                Forms\Components\TextInput::make('aquaculture_production_2020')->label('Aquaculture Production in 2020')->numeric(),
                Forms\Components\TextInput::make('aquaculture_production_2021')->label('Aquaculture Production in 2021')->numeric(),
                Forms\Components\TextInput::make('aquaculture_production_2022')->label('Aquaculture Production in 2022')->numeric()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country_name')->label('Country Name'),
                Tables\Columns\TextColumn::make('aquaculture_production_2020')->label('AP-2020'),
                Tables\Columns\TextColumn::make('aquaculture_production_2021')->label('AP-2021'),
                Tables\Columns\TextColumn::make('aquaculture_production_2022')->label('AP-2022'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAquacultureProductions::route('/'),
            'create' => Pages\CreateAquacultureProduction::route('/create'),
            'edit' => Pages\EditAquacultureProduction::route('/{record}/edit'),
        ];
    }
}
