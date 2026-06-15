<?php

namespace App\Filament\Resources\PackageOrders\Schemas;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Schemas\Schema;

class PackageOrderForm
{
    public static function configure(Schema $schema): Schema
    {
         return $schema
            ->schema([
                
                  Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->disabled(),

                      Forms\Components\Select::make('package_id')
                    ->label('Paket')
                    ->relationship('package', 'name')
                    ->disabled(),

                Forms\Components\TextInput::make('price')
                    ->label('Harga')
                    ->prefix('Rp')
                    ->disabled(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending'  => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->disabled(),
            ]);
    }
}
