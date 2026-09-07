<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DestinationController extends Controller
{
    public function index(): View
    {
        return view('admin.destinations.index', ['items' => Destination::orderBy('sort')->get()]);
    }

    public function create(): View
    {
        return view('admin.destinations.form', ['item' => null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['sort'] = (int) ($request->input('sort', 0));

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('destinasi', 'public');
        }

        Destination::create($data);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil ditambahkan.');
    }

    public function edit(Destination $destinasi): View
    {
        return view('admin.destinations.form', ['item' => $destinasi]);
    }

    public function update(Request $request, Destination $destinasi): RedirectResponse
    {
        $data = $this->validated($request);
        $data['active'] = $request->boolean('active');
        $data['sort'] = (int) ($request->input('sort', $destinasi->sort));

        if ($request->hasFile('image')) {
            if ($destinasi->image) {
                Storage::disk('public')->delete($destinasi->image);
            }
            $data['image'] = $request->file('image')->store('destinasi', 'public');
        }

        $destinasi->update($data);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil diperbarui.');
    }

    public function destroy(Destination $destinasi): RedirectResponse
    {
        if ($destinasi->image) {
            Storage::disk('public')->delete($destinasi->image);
        }
        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:alami,kota,wisata'],
            'gradient' => ['required', 'string', 'max:200'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);
    }
}