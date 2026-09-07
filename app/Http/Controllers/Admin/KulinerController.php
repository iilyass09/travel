<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KulinerSpot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KulinerController extends Controller
{
    public function index(): View
    {
        return view('admin.kuliner.index', ['items' => KulinerSpot::orderBy('sort')->get()]);
    }

    public function create(): View
    {
        return view('admin.kuliner.form', ['item' => null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['sort'] = (int) ($request->input('sort', 0));

        KulinerSpot::create($data);

        return redirect()->route('admin.kuliner.index')->with('success', 'Spot kuliner berhasil ditambahkan.');
    }

    public function edit(KulinerSpot $kuliner): View
    {
        return view('admin.kuliner.form', ['item' => $kuliner]);
    }

    public function update(Request $request, KulinerSpot $kuliner): RedirectResponse
    {
        $data = $this->validated($request);
        $data['active'] = $request->boolean('active');
        $data['sort'] = (int) ($request->input('sort', $kuliner->sort));

        $kuliner->update($data);

        return redirect()->route('admin.kuliner.index')->with('success', 'Spot kuliner berhasil diperbarui.');
    }

    public function destroy(KulinerSpot $kuliner): RedirectResponse
    {
        $kuliner->delete();

        return redirect()->route('admin.kuliner.index')->with('success', 'Spot kuliner berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tags' => ['nullable', 'string'],
            'gradient' => ['required', 'string', 'max:200'],
        ]);
    }
}