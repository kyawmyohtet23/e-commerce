<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;

class ReviewController extends Controller
{
    //
    public function makeReview(Request $request)
    {
        $review = $request->review;
        $rating = $request->rating;
        $user_id = auth()->id();
        $product_slug = $request->slug;

        $product = Product::where('slug', $product_slug)->first();
        if (!$product) {
            return 'product_not_found';
        }

        $created_review = ProductReview::create([
            'user_id' => $user_id,
            'product_id' => $product->id,
            'review' => $review,
            'rating' => $rating,
        ]);

        $created_review = ProductReview::where('id', $created_review->id)
            ->with('user')
            ->first();

        return response()->json($created_review);
    }
}
