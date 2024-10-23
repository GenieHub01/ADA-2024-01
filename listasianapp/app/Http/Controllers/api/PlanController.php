<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    // public function admin()
    // {
    //     $plans = Plan::paginate(10);
    //     return view('plans.admin', compact('plans'));
    // }

    // public function create()
    // {
    //     return view('plans.create');
    // }
    
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'stripe_id' => 'required|string',
    //         'name'      => 'required|string|max:255',
    //         'package'   => 'required|integer',
    //         'interval'  => 'required|integer|in:1,2,3',
    //         'amount'    => 'required|numeric',
    //         'currency'  => 'required|string',
    //     ]);

    //     try {
    //         $plan = Plan::create($validated);
    //         return redirect()->route('plans.admin')->with('success', 'Plan created successfully.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage())->withInput();
    //     }
    // }

    // public function edit()
    // {
    //     return view('plans.edit');
    // }
    
    // public function update(Request $request, $id)
    // {
    //     $plan = Plan::findOrFail($id);

    //     $validated = $request->validate([
    //         'stripe_id' => 'required|string',
    //         'name'      => 'required|string|max:255',
    //         'package'   => 'required|integer',
    //         'interval'  => 'required|integer|in:1,2,3',
    //         'amount'    => 'required|numeric',
    //         'currency'  => 'required|string',
    //     ]);

    //     try {
    //         $plan->update($validated);
    //         return redirect()->route('plans.admin')->with('success', 'Plan updated successfully.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage())->withInput();
    //     }
    // }

    // public function destroy($id)
    // {
    //     $plan = Plan::findOrFail($id);
    //     try {
    //         $plan->delete();
    //         return redirect()->route('plans.admin')->with('success', 'Plan deleted successfully.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }
}
