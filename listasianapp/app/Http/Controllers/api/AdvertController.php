<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AdvertCreated;
use App\Models\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class AdvertController extends Controller
{
    public function view($id)
    {
        $advert = Advert::findOrFail($id);

        if (!Gate::allows('update', $advert)) {
            abort(403, 'Access denied');
        }

        if (request()->isMethod('post')) {
            $cardInfo = strtolower(request('first-name') . request('last-name') . request('number') . request('cvc') . request('exp-month') . request('exp-year'));
            $cardHash = md5($cardInfo);

            $advert->purchase(request('stripeToken'), request('plan_id'), $cardHash);

            session()->flash('success', 'Thank you for your payment, Your advert will be live shortly');
            return redirect()->route('advert.thanks');
        }

        return view('adverts.view', compact('advert'));
    }

    public function display($id)
    {
        $advert = Advert::find($id);

        if (!$advert) {
            return redirect()->route('category.index');
        }

        if (request()->getRequestUri() != $advert->getSeoUrl()) {
            return redirect($advert->getSeoUrl(), 301);
        }

        return view('adverts.view', compact('advert'));
    }

    // public function create(Request $request)
    // {
    //     $advert = new Advert();

    //     /** @var \App\Models\User|null $user */
    //     $user = Auth::user();
    //     if (!$user || !$user->isAdmin()) {
    //         $advert->scenario = 'admin';
    //     }

    //     if ($request->isMethod('ajax')) {
    //         $advert->fill($request->all());
    //         $advert->file = $request->file('file');

    //         if ($advert->validate(['file']) && $advert->file instanceof \Illuminate\Http\UploadedFile) {
    //             $advert->saveImage();
    //             $advert->previewFile = $advert->image;
    //         }

    //         $html = view('adverts.partials.preview', compact('advert'))->render();

    //         return response()->json([
    //             'preview' => $advert->previewFile,
    //             'html' => $html
    //         ]);
    //     }

    //     if ($request->isMethod('post')) {
    //         $advert->fill($request->all());
    //         $advert->file = $request->file('file');
    //         $advert->categories = $request->input('categoryList', []);

    //         if ($advert->save()) {
    //             if (!config('app.debug')) {
    //                 Mail::to($advert->user->email)->send(new AdvertCreated($advert));
    //             }

    //             return redirect()->route('advert.view', ['id' => $advert->id]);
    //         }
    //     }

    //     return view('adverts.create', compact('advert'));
    // }

    // public function update($id, Request $request)
    // {
    //     $advert = Advert::findOrFail($id);

    //     if (!Gate::allows('update', $advert)) {
    //         abort(403, 'Access denied');
    //     }

    //     /** @var \App\Models\User|null $user */
    //     $user = Auth::user();

    //     if ($user && $user->isAdmin()) {
    //         $advert->scenario = 'admin';
    //     }

    //     if ($request->isMethod('post')) {
    //         $request->validate([
    //             'title'         => 'required|string|max:255',
    //             'description'   => 'required|string',
    //             'file'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    //             'categoryList'  => 'array',
    //             'categoryList.*'=> 'integer|exists:categories,id'
    //         ]);

    //         $advert->fill($request->except('file', 'categoryList'));

    //         if ($request->hasFile('file')) {
    //             $filePath = $request->file('file')->store('adverts_files', 'public');
    //             $advert->file = $filePath;
    //         }

    //         $advert->categories = $request->input('categoryList', []);

    //         if ($advert->save()) {
    //             return redirect()
    //                 ->route('advert.view', ['id' => $advert->id])
    //                 ->with('success', 'Advert updated successfully');
    //         } else {
    //             return back()->withErrors(['error' => 'Failed to save the advert. Please try again.']);
    //         }
    //     }

    // return view('adverts.update', compact('advert'));
    // }

    // public function delete($id)
    // {
    //     $advert = Advert::findOrFail($id);
    //     $advert->delete();

    //     return redirect()->route('advert.admin');
    // }

    public function index(Request $request)
    {
        $paid = $request->get('paid');
        $active = $request->get('active');

        $adverts = Advert::query()->getOwnList($paid, $active);

        return view('adverts.index', compact('adverts'));
    }

    // public function admin()
    // {
    //     $adverts = Advert::search()->paginate(10);
    //     return view('adverts.admin', compact('adverts'));
    // }

    // public function payTracking(Request $request)
    // {
    //     $user = Auth::user();
    //     $body = sprintf('User %s clicked "Submit Payment" button %s', $user->email, $request->post('url'));

    //     Mail::send('admin@example.com', 'Submit Payment Button clicked', $body);
    // }

    // public function thanks()
    // {
    //     return view('adverts.thanks');
    // }
}
