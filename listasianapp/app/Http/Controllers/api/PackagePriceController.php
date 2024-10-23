<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackagePriceRequest;
use App\Models\PackagePrice;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackagePriceController extends Controller
{
    // public function index()
    // {
    //     $packagePrices = PackagePrice::all();
    //     return view('package_price.index', compact('packagePrices'));
    // }

    // public function create()
    // {
    //     return view('package_price.create');
    // }

    // public function store(PackagePriceRequest $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'country_id'    => 'nullable|integer',
    //         'region_id'     => 'nullable|integer',
    //         'sub_region_id' => 'nullable|integer',
    //         'country_name'  => 'nullable|string|max:255',
    //         'region_name'   => 'nullable|string|max:255',
    //         'price_1'       => 'nullable|numeric',
    //         'price_2'       => 'nullable|numeric',
    //         'price_3'       => 'nullable|numeric',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $packagePrice = PackagePrice::create($request->all());

    //     return redirect()->route('package_price.index')->with('success', 'Package Price Created Successfully!');
    // }

    // public function show($id)
    // {
    //     $packagePrice = PackagePrice::findOrFail($id);
    //     return view('package_price.show', compact('packagePrice'));
    // }

    // public function edit($id)
    // {
    //     $packagePrice = PackagePrice::findOrFail($id);
    //     return view('package_price.edit', compact('packagePrice'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $packagePrice = PackagePrice::findOrFail($id);

    //     $validator = Validator::make($request->all(), [
    //         'country_id'    => 'nullable|integer',
    //         'region_id'     => 'nullable|integer',
    //         'sub_region_id' => 'nullable|integer',
    //         'country_name'  => 'nullable|string|max:255',
    //         'region_name'   => 'nullable|string|max:255',
    //         'price_1'       => 'nullable|numeric',
    //         'price_2'       => 'nullable|numeric',
    //         'price_3'       => 'nullable|numeric',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $packagePrice->update($request->all());
    //     return redirect()->route('package_price.index')->with('success', 'Package Price Updated Successfully!');
    // }

    // public function destroy($id)
    // {
    //     $packagePrice = PackagePrice::findOrFail($id);
    //     $packagePrice->delete();

    //     return redirect()->route('package_price.index')->with('success', 'Package Price Deleted Successfully!');
    // }

    // public function admin()
    // {
    //     $packagePrices = PackagePrice::paginate(10);
    //     return view('package_price.admin', compact('packagePrices'));
    // }
}
