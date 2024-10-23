<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PriceController extends Controller
{
    // function index()
    // {
    //     $prices = Price::paginate(10);

    //     return view('prices.index', compact('prices'));
    // }

    // function update(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'price.*'               => 'required|array',
    //         'price.*.id'            => 'required|exists:prices,id',
    //         'price.*.name'          => 'required|string',
    //         'price.*.value'         => 'required|numeric',
    //         'price.*.description'   => 'nullable|string'
    //     ]);

    //     $valid = true;

    //     foreach ($validatedData['price'] as $priceData) {
    //         try {
    //             $price = Price::find($priceData['id']);
    //             if ($price) {
    //                 $price->update($priceData);
    //             }
    //         } catch (\Exception $e) {
    //             Log::error('Price update failed', ['price_id' => $priceData['id'], 'error' => $e->getMessage()]);
    //             $valid = false;
    //         }
    //     }

    //     if ($valid) {
    //         return redirect()->route('prices.index')->with('success', 'Prices updated successfully.');
    //     }

    //     return redirect()->back()->with('error', 'Failed to update prices.');
    // }
}
