<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registrations.create');
    }

    public function success(Request $request, $payID)
    {
        $record = Registration::where('pay_id', $payID)->first();

        if (!$record) {
            abort(404);
        }

        $trxID = $record->trx_id;
        $tickets = $record->tickets;
        $regNo = $record->reg_no;

        return view('registrations.success', compact('trxID', 'tickets', 'regNo'));
    }
}
