<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $propertyId)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id' // Validasi baru
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'property_id' => $propertyId,
            'body' => $request->body,
            'parent_id' => $request->parent_id
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}