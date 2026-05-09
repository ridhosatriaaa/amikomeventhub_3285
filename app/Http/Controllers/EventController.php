<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DETAIL EVENT
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('event-detail', compact('event'));
    }


    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function checkout()
    {
        return view('checkout');
    }
}