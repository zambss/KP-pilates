<?php

namespace App\Filament\Resources\ClassPrices;

use App\Filament\Resources\ClassPrices\Pages\CreateClassPrice;
use App\Filament\Resources\ClassPrices\Pages\EditClassPrice;
use App\Filament\Resources\ClassPrices\Pages\ListClassPrices;
use App\Filament\Resources\ClassPrices\Schemas\ClassPriceForm;
use App\Filament\Resources\ClassPrices\Tables\ClassPricesTable;
use App\Models\ClassPrice;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ClassPriceResource extends Resource
{
    protected static ?string $model = ClassPrice::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
     protected static string|UnitEnum|null $navigationGroup = 'Master Data';
    protected static ?string $modelLabel = 'Class Price';
    protected static ?int $navigationSort = 6;
    public static function form(Schema $schema): Schema
    {
        return ClassPriceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClassPricesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
 public static function canAccess(): bool
    {
        $user = Auth::user();

        return $user && $user->role === 'super_admin';
    }
    public static function getPages(): array
    {
        return [
            'index' => ListClassPrices::route('/'),
            'create' => CreateClassPrice::route('/create'),
            'edit' => EditClassPrice::route('/{record}/edit'),
        ];
    }
}
