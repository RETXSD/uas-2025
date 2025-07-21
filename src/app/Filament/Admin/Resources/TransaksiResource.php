<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TransaksiResource\Pages;
use App\Filament\Admin\Resources\TransaksiResource\RelationManagers;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions;
use Filament\Tables\Actions\BulkActionGroup;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Transaksi';


    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Load relasi user untuk menampilkan nama pembeli
        $query->with('user');

        $user = Auth::user();
        
        // Jika user adalah super_admin, tampilkan semua transaksi
        if ($user->hasRole('super_admin')) {
            return $query;
        }
        
        // Jika user adalah pembeli, hanya tampilkan transaksi miliknya
        if ($user->hasRole('pembeli')) {
            $query->where('user_id', Auth::id());
        }

        return $query;
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Forms\Components\Hidden::make('user_id')
                        ->default(Auth::id()),
                        
                    Forms\Components\TextInput::make('user.name')
                        ->label('Nama Pembeli')
                        ->default(Auth::user()->name)
                        ->disabled()
                        ->dehydrated(false), // Jangan simpan ke database karena ini hanya display
                        
                    Forms\Components\Select::make('product_name')
                        ->label('Product Name')
                        ->options(Product::pluck('name', 'name'))
                        ->searchable()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            if ($state) {
                                $product = Product::where('name', $state)->first();
                                if ($product) {
                                    $set('price', $product->price);
                                }
                            } else {
                                $set('price', null);
                            }
                        }),
                        
                    Forms\Components\TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->prefix('Rp')
                        ->disabled() // Auto-fill dari product
                        ->dehydrated(), // Tetap simpan ke database
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                    ])
                    ->default('pending'),
                    Forms\Components\FileUpload::make('receipt')
                    ->label('Upload Struk')
                    ->image()
                    ->directory('receipts') // folder di storage/app/public/receipts
                    ->imagePreviewHeight('150')
                    ->enableOpen()
                    
            ])->columns(2);

                    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id')
                //     ->sortable()
                //     ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Pembeli')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->sortable(),
                    Tables\Columns\ImageColumn::make('receipt'),
                    Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'completed' => 'success',
                        'failed' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                        default => $state,
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}