<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transport;

class TransportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('user.transport.index', [
            'title' => 'Daftar Kendaraan',
            'transports' => Transport::with(['merek'])->orderBy('name')->paginate(10),
        ]);
    }
}
