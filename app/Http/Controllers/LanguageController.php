<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('Admin.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('Admin.languages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'language_name' => 'required|string|max:255'
        ]);

        Language::create([
            'language_name' => $request->language_name
        ]);

        return redirect()->route('admin.languages.index')->with('success', 'Language added successfully!');
    }

    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('Admin.languages.edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        
        $request->validate([
            'language_name' => 'required|string|max:255'
        ]);

        $language->update([
            'language_name' => $request->language_name
        ]);

        return redirect()->route('admin.languages.index')->with('success', 'Language updated successfully!');
    }

    public function destroy($id)
    {
        Language::findOrFail($id)->delete();
        return redirect()->route('admin.languages.index')->with('success', 'Language deleted successfully!');
    }

    public function show($id)
    {
        $language = Language::findOrFail($id);
        return view('Admin.languages.show', compact('language'));
    }
}