<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('id', 'DESC')->get();
        return view('admin.country_index', compact('countries'));
    }

    public function create()
    {
        return view('admin.country_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:countries,title|max:255',
            'slug'  => 'nullable|unique:countries,slug|max:255',
        ]);

        Country::create([
            'title' => $request->title,
            'slug'  => $request->slug ?? Str::slug($request->title),
        ]);

        return redirect()->route('admin.country');
    }

    public function edit(string $id)
    {
        $country = Country::findOrFail($id);
        return view('admin.country_edit', compact('country'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255|unique:countries,title,' . $id,
            'slug'  => 'nullable|max:255|unique:countries,slug,' . $id,
        ]);

        $country = Country::findOrFail($id);

        $country->title = $request->title;
        $country->slug = $request->slug ? $request->slug : \Illuminate\Support\Str::slug($request->title);
        $country->save();
        
        return redirect()->route('admin.country');
    }

    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('admin.country');
    }
}
