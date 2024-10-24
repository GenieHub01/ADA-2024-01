<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paylog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaylogController extends Controller
{
    // public function index()
    // {
    //     $userId = Auth::id();
    //     $payments = (new Paylog())->getPayments($userId);

    //     return view('paylogs.index', compact('payments'));
    // }

    // public function create()
    // {
    //     return view('paylogs.create');
    // }
    
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id'       => 'required|integer',
    //         'advert_id'     => 'required|integer',
    //         'amount'        => 'required|numeric',
    //         'description'   => 'nullable|string',
    //         'token'         => 'nullable|string',
    //         'create_time'   => 'nullable|date',
    //         'active'        => 'required|integer'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $paylog = Paylog::create($request->all());

    //     return redirect()->route('paylogs.index')->with('success', 'Paylog created successfully.');
    // }

    // public function show($id)
    // {
    //     $paylog = Paylog::findOrFail($id);
    //     return view('paylogs.show', compact('paylog'));
    // }

    // public function edit($id)
    // {
    //     $paylog = Paylog::findOrFail($id);
    //     return view('paylogs.edit', compact('paylog'));
    // }

    
    // public function update(Request $request, $id)
    // {
    //     $paylog = Paylog::findOrFail($id);

    //     $validator = Validator::make($request->all(), [
    //         'user_id'       => 'required|integer',
    //         'advert_id'     => 'required|integer',
    //         'amount'        => 'required|numeric',
    //         'description'   => 'nullable|string',
    //         'token'         => 'nullable|string',
    //         'create_time'   => 'nullable|date',
    //         'active'        => 'required|integer'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $paylog->update($request->all());

    //     return redirect()->route('paylogs.index')->with('success', 'Paylog updated successfully.');
    // }

    // public function destroy($id)
    // {
    //     $paylog = Paylog::findOrFail($id);
    //     $paylog->delete();

    //     return redirect()->route('paylogs.index')->with('success', 'Paylog deleted successfully.');
    // }

    // public function admin()
    // {
    //     $paylogs = Paylog::paginate(10);
    //     return view('admin.paylogs', compact('paylogs'));
    // }
}
