<?php

namespace App\Filament\Resources\ClassOrders;

use App\Filament\Resources\ClassOrders\Pages\CreateClassOrder;
use App\Filament\Resources\ClassOrders\Pages\EditClassOrder;
use App\Filament\Resources\ClassOrders\Pages\ListClassOrders;
use App\Filament\Resources\ClassOrders\Schemas\ClassOrderForm;
use App\Filament\Resources\ClassOrders\Tables\ClassOrdersTable;
use App\Models\ClassOrder;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ClassOrderResource extends Resource
{
    protected static ?string $model = ClassOrder::class;
    protected static string|UnitEnum|null $navigationGroup = 'Transaksi';
    protected static ?string $modelLabel = 'Class Order';
    protected static ?int $navigationSort = 6;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ClassOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClassOrdersTable::configure($table);
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
            'index' => ListClassOrders::route('/'),
            'create' => CreateClassOrder::route('/create'),
            'edit' => EditClassOrder::route('/{record}/edit'),
        ];
    }
}
