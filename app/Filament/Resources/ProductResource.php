<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Storage;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Form definition for creating and editing products
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        // Product Name
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Product Name'),

                        // Product Description
                        Textarea::make('description')
                            ->required()
                            ->label('Product Description'),

                        // Product Image Upload
                        FileUpload::make('image')
                            ->image()
                            ->required()
                            ->disk('public') // Ensures the file is stored in the public disk
                            ->directory('images') // Stores files in the 'images' folder
                            ->label('Product Image'),

                        // Sizes Field (Comma-separated string that gets stored as an array)
                        TextInput::make('size')
                            ->required()
                            ->label('Sizes (Comma separated)')
                            ->helperText('Enter sizes separated by commas, e.g., S, M, L, XL'),

                        // Colors Field (Comma-separated string that gets stored as an array)
                        TextInput::make('color')
                            ->required()
                            ->label('Colors (Comma separated)')
                            ->helperText('Enter colors separated by commas, e.g., Red, Blue, Green'),

                        // Product Price
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->label('Price (RS)')
                            ->helperText('Enter the product price, e.g., 19.99'),
                    ]),
            ]);
    }

    // Table definition for listing products
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                // Product Name
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Product Name'),

                // Product Description
                TextColumn::make('description')
                    ->limit(50)
                    ->label('Description'),

                // Product Image
                ImageColumn::make('image')
                    ->label('Product Image')
                    ->getStateUsing(fn($record) => Storage::disk('public')->url('images/' . $record->image)),

                // Sizes (Display the array as a string)
                TextColumn::make('size')
                    ->label('Sizes')
                    ->getStateUsing(fn($record) => is_array($record->size) ? implode(', ', $record->size) : $record->size),

                // Colors (Display the array as a string)
                TextColumn::make('color')
                    ->label('Colors')
                    ->getStateUsing(fn($record) => is_array($record->color) ? implode(', ', $record->color) : $record->color),

                TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->getStateUsing(fn($record) => $record->price ? number_format($record->price, 2) : 'N/A') // Check if price is present and format it
                    ->money('RS', true),
                
            ])
            ->filters([]) // Add filters if needed
            ->actions([
                // Edit Product
                Tables\Actions\EditAction::make(),

                // Delete Product
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    // Define the pages for product resource
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
