<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Filament\Notifications\Notification;

class FilamentForm extends Controller
{
    public static  function notification($message = 'Saved successfully')
    {

        Notification::make()
            ->title($message)
            ->success()
            ->send();
    }
    public static  function error($message = 'Saved successfully')
    {

        Notification::make()
            ->title($message)
            ->danger()
            ->send();
    }
}
