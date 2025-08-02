<?php

namespace App\Http\Controllers;

use App\Services\ShopifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct(
        protected ShopifyService $shopify
    ) {}

    /**
     * Handle checkout creation (variant ID only)
     */
    public function create(Request $request)
    {   
        $request->validate([
            'variant_id' => 'required|string'
        ]);

        $result = $this->shopify->createCheckout(
            $request->input('variant_id')
        );

        if (!isset($result['checkout']) || $result['checkout'] === null) {
            Log::error('Checkout creation failed', [
                'response' => $result
            ]);

            return back()
                ->withErrors($result['userErrors'] ?? ['Checkout creation failed'])
                ->withInput();
        }


        return redirect()->away($result['checkout']['webUrl'] . '&test=true');
    }

    public function index(Request $request) {
        return view('pages.checkout');
    }
}