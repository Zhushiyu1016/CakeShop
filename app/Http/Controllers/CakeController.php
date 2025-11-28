<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cakes = Cake::with('user')->latest()->get();
        return view('cakes.index', compact('cakes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Cake::class);
        return view('cakes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Cake::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ], [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'description.min' => 'The description must be at least 10 characters.',
            'image.required' => 'Please upload an image.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image size must not exceed 5MB.',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cakes', 'public');
            $validated['image_path'] = $imagePath;
        }

        $validated['user_id'] = Auth::id();

        Cake::create($validated);

        return redirect()->route('cakes.index')
            ->with('success', 'Cake created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cake $cake)
    {
        $cake->load('user');
        return view('cakes.show', compact('cake'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cake $cake)
    {
        $this->authorize('update', $cake);
        return view('cakes.edit', compact('cake'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cake $cake)
    {
        $this->authorize('update', $cake);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'description.min' => 'The description must be at least 10 characters.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image size must not exceed 5MB.',
        ]);

        // Handle file upload if new image is provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($cake->image_path) {
                Storage::disk('public')->delete($cake->image_path);
            }
            $imagePath = $request->file('image')->store('cakes', 'public');
            $validated['image_path'] = $imagePath;
        }

        $cake->update($validated);

        return redirect()->route('cakes.index')
            ->with('success', 'Cake updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cake $cake)
    {
        $this->authorize('delete', $cake);

        // Delete image file
        if ($cake->image_path) {
            Storage::disk('public')->delete($cake->image_path);
        }

        $cake->delete();

        return redirect()->route('cakes.index')
            ->with('success', 'Cake deleted successfully!');
    }
}
