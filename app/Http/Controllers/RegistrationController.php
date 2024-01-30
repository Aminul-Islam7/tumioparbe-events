<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::all();
        $count = Registration::whereNotNull('reg_no')->count();
        $totalTickets = Registration::whereNotNull('reg_no')->sum('tickets');

        return view('registrations.index', [
            'registrations' => $registrations,
            'count' => $count,
            'totalTickets' => $totalTickets
        ]);
    }

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

    public function cancel(Request $request, $payID)
    {
        $record = Registration::where('pay_id', $payID)->first();

        if (!$record || !($record->status == 'cancel')) {
            abort(404);
        }

        return view('registrations.cancel');
    }

    public function failure(Request $request, $payID)
    {
        $record = Registration::where('pay_id', $payID)->first();

        if (!$record || !($record->status == 'failure')) {
            abort(404);
        }

        return view('registrations.failure');
    }
}
