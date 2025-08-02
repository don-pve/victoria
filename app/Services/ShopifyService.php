<?php

namespace App\Services;

use Shopify\Clients\Graphql;
use Shopify\Exception\ShopifyException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class ShopifyService
{
    private string $storefrontToken;
    private string $storeDomain;
    private string $apiVersion;

    public function __construct()
    {
        // $this->storeDomain = config('services.shopify.storefront_domain');
        // $this->storefrontToken = config('services.shopify.storefront_token');
        // $this->apiVersion = config('services.shopify.api_version', '2025-07');

        $this->storeDomain = config('services.shopify.storefront_domain'); // ✅
        $this->storefrontToken = config('services.shopify.storefront_token');
        $this->apiVersion = config('services.shopify.api_version', '2025-07');

    }

    public function createCheckout(string $variantId): array
    {
        $endpoint = "https://{$this->storeDomain}/api/{$this->apiVersion}/graphql.json";

        $query = <<<'GRAPHQL'
        mutation checkoutCreate($input: CheckoutCreateInput!) {
            checkoutCreate(input: $input) {
                checkout {
                    id
                    webUrl
                }
                userErrors {
                    field
                    message
                }
            }
        }
        GRAPHQL;

        $variables = [
            'input' => [
                'lineItems' => [[
                    'variantId' => $variantId,
                    'quantity' => 1
                ]]
            ]
        ];

        Log::info('Sending token:', ['token' => $this->storefrontToken]);

        $response = Http::withHeaders([
            'X-Shopify-Storefront-Access-Token' => $this->storefrontToken,
            'Content-Type' => 'application/json',
        ])->post($endpoint, [
            'query' => $query,
            'variables' => $variables,
        ]);

        $body = $response->json();

        // 🔍 Log the full Shopify response for debugging
        Log::debug('Shopify checkoutCreate raw response', $body);
        Log::info('Using Shopify Storefront endpoint: ' . $endpoint);

        return $body['data']['checkoutCreate'] ?? [
            'checkout' => null,
            'userErrors' => ['Invalid API response']
        ];
    }
}
