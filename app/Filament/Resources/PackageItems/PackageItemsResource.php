<?php

namespace App\Filament\Resources\PackageItems;

use App\Filament\Resources\PackageItems\Pages\CreatePackageItems;
use App\Filament\Resources\PackageItems\Pages\EditPackageItems;
use App\Filament\Resources\PackageItems\Pages\ListPackageItems;
use App\Filament\Resources\PackageItems\Schemas\PackageItemsForm;
use App\Filament\Resources\PackageItems\Tables\PackageItemsTable;
use App\Models\PackageItem;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PackageItemsResource extends Resource
{
    protected static ?string $model = PackageItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
 protected static string|UnitEnum|null $navigationGroup = 'Master Data';
    protected static ?string $modelLabel = 'Promo Item';
    protected static ?int $navigationSort = 6;
    public static function form(Schema $schema): Schema
    {
        return PackageItemsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PackageItemsTable::configure($table);
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
            'index' => ListPackageItems::route('/'),
            'create' => CreatePackageItems::route('/create'),
            'edit' => EditPackageItems::route('/{record}/edit'),
        ];
    }
}
