<?php

namespace App\Filament\Admin\Pages\Auth;

use App\Models\Pembeli;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class Register extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    protected function handleRegistration(array $data): Model
    {
        // Buat user
        $user = $this->getUserModel()::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        
        // Auto-assign role pembeli
        $user->assignRole('pembeli');
        
        // Auto-create record di tabel pembeli
        Pembeli::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);

        event(new Registered($user));

        // // Kirim email tanpa view (plain text)
        // Mail::raw("Halo {$user->name}, terima kasih telah mendaftar di aplikasi kami!", function ($message) use ($user) { $message->to($user->email)
        //     ->subject('Selamat Datang di Aplikasi Kami');
        // });

        return $user;

        
    }

    
}