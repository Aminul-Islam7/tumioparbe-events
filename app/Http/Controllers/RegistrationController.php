<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::orderBy('reg_no', 'desc')->get();
        $count = Registration::whereNotNull('reg_no')->count();
        $totalTickets = Registration::whereNotNull('reg_no')->sum('tickets');
        $totalFund = Registration::whereNotNull('reg_no')->sum('amount');


        return view('registrations.index', [
            'registrations' => $registrations,
            'count' => $count,
            'totalTickets' => $totalTickets,
            'totalFund' => $totalFund
        ]);
    }

    public function settings()
    {
        $registrations = Registration::orderBy('reg_no', 'desc')->get();
        $count = Registration::whereNotNull('reg_no')->count();
        $totalTickets = Registration::whereNotNull('reg_no')->sum('tickets');
        $totalFund = Registration::whereNotNull('reg_no')->sum('amount');


        return view('registrations.index', [
            'registrations' => $registrations,
            'count' => $count,
            'totalTickets' => $totalTickets,
            'totalFund' => $totalFund
        ]);
    }

    public function search(Request $request)
    {
        $registrations = Registration::where('reg_no', 'like', '%'. $request->search_string . '%')
                                    ->orWhere('name', 'like', '%' . $request->search_string . '%')
                                    ->orWhere('phone', 'like', '%' . $request->search_string . '%')
                                    ->orWhere('district', 'like', '%' . $request->search_string . '%')
                                    ->orWhere('bkash_number', 'like', '%' . $request->search_string . '%')
                                    ->orWhere('trx_id', 'like', '%' . $request->search_string . '%')
                                    ->orderBy('reg_no', 'desc')
                                    ->get();
                                    
        $count = $registrations->count();
        $totalTickets = Registration::whereNotNull('reg_no')->sum('tickets');
        
        return view('registrations.search', compact('registrations', 'count', 'totalTickets'));
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
