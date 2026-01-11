<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'body' => 'required|string|max:1000',
            'rating' => 'nullable|integer|min:1|max:5'
        ];

        if (!auth()->check()) {
            $rules['guest_name'] = 'required|string|max:50';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $review = Review::create([
            'user_id' => auth()->id(),
            'guest_name' => auth()->check() ? null : $request->guest_name,
            'rating' => $request->rating,
            'body' => $request->body,
        ]);

        // Prepare response payload
        $payload = [
            'id' => $review->id,
            'body' => e($review->body),
            'rating' => $review->rating,
            'name' => $review->user ? $review->user->name : ($review->guest_name ?? 'Guest'),
            'created_at' => $review->created_at->diffForHumans(),
        ];

        return response()->json(['success' => true, 'review' => $payload]);
    }
}
