<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registrations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^01[3-9]\d{8}$/'],
            'tickets' => ['required', 'integer', 'min:1'],
        ],
        [
            'name' => 'নামটি সঠিক ভাবে লিখুন।',
            'phone' => 'ফোন নম্বরটি সঠিক নয়।',
            'tickets' => 'কমপক্ষে ১ টি টিকেট নিতে হবে।',
        ]);

        return redirect('/');
    }
}
