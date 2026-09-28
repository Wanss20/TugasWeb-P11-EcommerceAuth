<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Select::make('address_id')
                    ->relationship('address', 'address')
                    ->default(null),
                TextInput::make('order_number')
                    ->required(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('Rp'),
                Select::make('status')
                    ->options([
            'pending' => 'Pending',
            'paid' => 'Paid',
            'shipped' => 'Shipped',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
