<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Récupère les notifications de l'utilisateur connecté s'il y en a
        $notifications = auth()->user() ? auth()->user()->notifications : [];

        return view('notifications', compact('notifications'));
    }
}
