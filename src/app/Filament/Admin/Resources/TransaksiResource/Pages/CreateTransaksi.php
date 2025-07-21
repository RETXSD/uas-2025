<?php

namespace App\Filament\Admin\Resources\TransaksiResource\Pages;

use App\Filament\Admin\Resources\TransaksiResource\Pages;
use App\Filament\Admin\Resources\TransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateTransaksi extends CreateRecord
{
    protected static string $resource = TransaksiResource::class;
    protected static ?string $title = "Tambah Transaksi";

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id(); // Auto-fill user yang login
        
        return $data;
    }
}
