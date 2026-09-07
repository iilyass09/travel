<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShoppingSpot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShoppingController extends Controller
{
    public function index(): View
    {
        return view('admin.shopping.index', ['items' => ShoppingSpot::orderBy('sort')->get()]);
    }

    public function create(): View
    {
        return view('admin.shopping.form', ['item' => null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['sort'] = (int) ($request->input('sort', 0));

        ShoppingSpot::create($data);

        return redirect()->route('admin.shopping.index')->with('success', 'Tempat shopping berhasil ditambahkan.');
    }

    public function edit(ShoppingSpot $shopping): View
    {
        return view('admin.shopping.form', ['item' => $shopping]);
    }

    public function update(Request $request, ShoppingSpot $shopping): RedirectResponse
    {
        $data = $this->validated($request);
        $data['active'] = $request->boolean('active');
        $data['sort'] = (int) ($request->input('sort', $shopping->sort));

        $shopping->update($data);

        return redirect()->route('admin.shopping.index')->with('success', 'Tempat shopping berhasil diperbarui.');
    }

    public function destroy(ShoppingSpot $shopping): RedirectResponse
    {
        $shopping->delete();

        return redirect()->route('admin.shopping.index')->with('success', 'Tempat shopping berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'gradient' => ['required', 'string', 'max:200'],
            'icon_light' => ['nullable', 'string', 'max:100'],
            'sort' => ['nullable', 'integer'],
        ]);
    }
}