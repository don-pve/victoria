<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ShopifyService
{
    private string $storeDomain;
    private string $adminToken;
    private string $apiVersion;

    public function __construct()
    {
        $this->storeDomain = config('services.shopify.admin_domain');
        $this->adminToken = config('services.shopify.admin_token');
        $this->apiVersion = config('services.shopify.api_version', '2025-07');
    }

    public function createCheckout(string $variantId, ?string $customerEmail = null): array
    {
        $numericVariantId = $this->getVariantNumericId($variantId);
        if (!$numericVariantId) {
            return [
                'checkout' => null,
                'userErrors' => ['Invalid variant ID format']
            ];
        }

        $draftOrderPayload = [
            'draft_order' => [
                'line_items' => [
                    [
                        'variant_id' => $numericVariantId,
                        'quantity' => 1,
                    ]
                ],
                'use_customer_default_address' => true
            ]
        ];

        if ($customerEmail) {
            $draftOrderPayload['draft_order']['email'] = $customerEmail;
        }

        $headers = [
            'X-Shopify-Access-Token' => $this->adminToken,
            'Content-Type' => 'application/json',
        ];

        // Step 1: Create Draft Order
        $createResponse = Http::withHeaders($headers)->post(
            "https://{$this->storeDomain}/admin/api/{$this->apiVersion}/draft_orders.json",
            $draftOrderPayload
        );

        $created = $createResponse->json();

        if (empty($created['draft_order']['id'])) {
            Log::error('Failed to create draft order', ['response' => $created]);
            return [
                'checkout' => null,
                'userErrors' => ['Failed to create draft order']
            ];
        }

        $draftOrderId = $created['draft_order']['id'];

        // Step 2: Send the invoice so Shopify makes invoice_url accessible
        $sendInvoiceResponse = Http::withHeaders($headers)->post(
            "https://{$this->storeDomain}/admin/api/{$this->apiVersion}/draft_orders/{$draftOrderId}/send_invoice.json",
            [
                'draft_order_invoice' => [
                    'to' => $customerEmail ?? 'test@example.com', // Fallback email
                    'custom_message' => 'Here is your payment link.'
                ]
            ]
        );

        Log::info('Invoice sent', [
            'id' => $draftOrderId,
            'send_invoice_response' => $sendInvoiceResponse->json()
        ]);

        return [
            'checkout' => [
                'webUrl' => $created['draft_order']['invoice_url'] ?? null
            ],
            'userErrors' => []
        ];
    }

    private function getVariantNumericId(string $gid): ?int
    {
        if (preg_match('/(\d+)$/', $gid, $matches)) {
            return (int) $matches[1];
        }

        return null;
    }
}
