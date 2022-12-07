<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialResource\Pages;
use App\Filament\Resources\MaterialResource\RelationManagers;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static ?string $navigationIcon = 'heroicon-o-desktop-computer';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['descricao', 'marca', 'modelo','observacao'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('sala')
                        ->datalist(Material::get()->pluck('sala')->unique())
                        ->required()
                        ->autofocus()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('descricao')
                        ->datalist(Material::get()->pluck('descricao')->unique())
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('tombo')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('orgao')
                        ->options([
                            'UFCG' => 'UFCG',
                            'UFPB' => 'UFPB',
                            '-' => '-',
                        ])
                        ->default('UFCG')
                        ->required(),

                    Forms\Components\TextInput::make('marca')
                        ->datalist(Material::get()->pluck('marca')->unique())
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('modelo')
                        ->datalist(Material::get()->pluck('modelo')->unique())
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('responsavel')
                        ->datalist(Material::get()->pluck('responsavel')->unique())
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('origem')
                        ->datalist(Material::get()->pluck('origem')->unique())
                        ->default('UFCG')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('estado')
                    ->options([
                        'Em uso' => 'Em Uso',
                        'Ocioso' => 'Ocioso',
                        'Antieconômico' => 'AntiEconômico',
                        'Recuperável' => 'Recuperável',
                        'Inservível/Irrecuperável' => 'Inservível/Irrecuperável',
                    ])
                    ->default('Em uso')
                    ->required(),

                    Forms\Components\Textarea::make('observacao')
                        ->maxLength(65535),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // SpatieMediaLibraryImageColumn::make('equip')->conversion('preview'),
                Tables\Columns\TextColumn::make('sala')
                    ->limit(40)
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('descricao')
                    ->limit(40)
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tombo')
                    ->sortable()
                    ->limit(10),

                Tables\Columns\TextColumn::make('marca')->limit(10),

                Tables\Columns\TextColumn::make('modelo')->limit(10),

                Tables\Columns\TextColumn::make('responsavel')->limit(10),

                Tables\Columns\TextColumn::make('origem')->limit(10),

                Tables\Columns\TextColumn::make('estado'),

            ])
            ->defaultSort('id', 'desc')

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}
