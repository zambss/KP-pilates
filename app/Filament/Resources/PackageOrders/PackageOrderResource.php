<?php

namespace App\Filament\Resources\PackageOrders;

use App\Filament\Resources\PackageOrders\Pages\CreatePackageOrder;
use App\Filament\Resources\PackageOrders\Pages\EditPackageOrder;
use App\Filament\Resources\PackageOrders\Pages\ListPackageOrders;
use App\Filament\Resources\PackageOrders\Schemas\PackageOrderForm;
use App\Filament\Resources\PackageOrders\Tables\PackageOrdersTable;

use App\Models\PackageOrderr;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PackageOrderResource extends Resource
{
    protected static ?string $model = PackageOrderr::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
 protected static string|UnitEnum|null $navigationGroup = 'Transaksi';
    protected static ?string $modelLabel = 'Promo Order';
    protected static ?int $navigationSort = 6;
    public static function form(Schema $schema): Schema
    {
        return PackageOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PackageOrdersTable::configure($table);
    }
 public static function canAccess(): bool
    {
        $user = Auth::user();

        return $user && $user->role === 'super_admin';
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
            'index' => ListPackageOrders::route('/'),
            'create' => CreatePackageOrder::route('/create'),
            'edit' => EditPackageOrder::route('/{record}/edit'),
        ];
    }
}
