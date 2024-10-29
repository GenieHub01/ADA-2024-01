<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeoFormRequest;
use App\Models\Advert;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = $this->loadModel($id);
        return view('category.show', compact('category'));
    }

    public function list(Request $request)
    {
        if ($request->isMethod('post')) {
            $categoryId = $request->input('Advert.category_id');
            $categories = Category::where('parent_id', $categoryId)->get();

            $options = '';
            foreach ($categories as $category) {
                $options .= '<option value="' . $category->id . '">' . e($category->name) . '</option>';
            }

            return response()->json(['data' => $options], 200);
        }

        return view('category.list')->with('message', 'Invalid request method.');
    }

//     public function createForm()
//     {
//         $category = Category::all();

//         return view('category.create', compact('category'));
//     }
    
//     public function create(Request $request)
//     {
//         $category = new Category();

//         if ($request->isMethod('post')) {
//             $validatedData = $request->validate([
//                 'code'      => 'required|string|max:255',
//                 'parent_id' => 'nullable|integer',
//                 'name'      => 'required|string|max:255',
//                 'url'       => 'nullable|string|max:255',
//             ]);

//             $category->fill($validatedData);
//             if ($category->save()) {
//                 return redirect()->route('category.show', $category->id)->with('message', 'Category created successfully!');
//             }

//             return redirect()->back()->with('error', 'Failed to create category');
//         }

//         return view('category.create');
//     }

//     public function edit($id)
//     {
//     $category = $this->loadModel($id);

//     return view('category.edit', compact('category'));
//     }

    
//     public function update(Request $request, $id)
//     {
//         $category = $this->loadModel($id);

//         if ($request->isMethod('post')) {
//             $validatedData = $request->validate([
//                 'code'      => 'required|string|max:255',
//                 'parent_id' => 'nullable|integer',
//                 'name'      => 'required|string|max:255',
//                 'url'       => 'nullable|string|max:255',
//             ]);

//             $category->fill($validatedData);
//             if ($category->save()) {
//                 return redirect()->route('category.show', $category->id)->with('message', 'Category updated successfully!');
//             }

//             return redirect()->back()->with('error', 'Failed to update category');
//         }

//         return view('category.edit', compact('category'));
//     }

//     public function destroy($id)
//     {
//         $category = $this->loadModel($id);
//         $category->delete();

//         return redirect()->route('category.index')->with('message', 'Category deleted successfully!');
//     }

    public function index(Request $request, $code = null)
    {
        $category = Category::where('code', $code)->first();
        $q = $request->input('q', null);
        $t = $request->input('t', 0);

        if ($request->has('name')) {
            $body = 'Name: ' . $request->input('name') . '<br>';
            $body .= 'Email: ' . $request->input('email') . '<br>';
            $body .= 'Phone: ' . $request->input('phone') . '<br>';
            $body .= 'Website: ' . $request->input('website') . '<br>';
            $body .= 'Message: ' . nl2br($request->input('message'));

            Mail::raw($body, function ($message) {
                $message->to('info@example.com')
                        ->subject('Contact Form');
            });
        }

        $geoForm = $request->session()->get('geoForm', new GeoFormRequest());

        if ($request->isMethod('post') && $request->has('GeoForm')) {
            $geoForm->fill($request->input('GeoForm'));
            $request->session()->put('geoForm', $geoForm);
        }

        $categoryInstance = new Category();
        $treeViewData = $categoryInstance->getTreeviewData();

        $dataProvider = $t == 1 
            ? Category::where('name', 'like', "%{$q}%")->get() 
            : Advert::where('category_id', $category->id)->get();

        return view('category.index', compact('treeViewData', 'dataProvider', 'geoForm', 'category'));
    }

    public function paidAdverts($type, $url)
    {
        $category = Category::where('url', $url)->first();
        $dataProvider = Advert::where('category_id', $category->id)->where('paid', true)->get();

        return view('category.paid_adverts', compact('category', 'dataProvider'));
    }

//     public function admin()
//     {
//         $categories = Category::all();
//         return view('category.admin', compact('categories'));
//     }

    protected function loadModel($id)
    {
        return Category::findOrFail($id);
    }
}
