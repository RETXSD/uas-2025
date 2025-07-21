<?php

namespace App\Filament\Admin\Resources\PembeliResource\Pages;


use App\Filament\Admin\Resources\PembeliResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
class EditPembeli extends EditRecord
{
    protected static string $resource = PembeliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),

            Action::make('requestApiToken')
                ->label('Request API Token')
                ->action('requestApiToken')
                ->color('success')
                ->icon('heroicon-o-key')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->api_token = str::random(10);
                    $this->record->save();
                    $this->fillForm();
                        Notification::make()
                        ->title('New API Token Generated')
                        ->success()
                        ->send();
                    
                   
                })
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
       if(empty($data['api_token'])){
            $data['api_token'] = Str::random(10);
        }
    }
}
