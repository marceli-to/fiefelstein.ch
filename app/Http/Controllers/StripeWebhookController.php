<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Pdf\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderConfirmationNotification;
use App\Notifications\OrderInformationNotification;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $webhookSecret
            );
        } catch (\UnexpectedValueException $e) {
            Log::error('Stripe webhook: Invalid payload');
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Stripe webhook: Invalid signature');
            return response('Invalid signature', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $this->handleCheckoutSessionCompleted($session);
        }

        return response('OK', 200);
    }

    private function handleCheckoutSessionCompleted($session)
    {
        $order = Order::where('stripe_session_id', $session->id)->first();

        if (!$order) {
            Log::error('Stripe webhook: Order not found for session ' . $session->id);
            return;
        }

        if ($order->payed_at) {
            Log::info('Stripe webhook: Order already paid ' . $order->uuid);
            return;
        }

        // Mark order as paid
        $order->payed_at = now();
        $order->save();

        // Load order products for invoice
        $order = Order::with('orderProducts')->find($order->id);

        // Generate invoice and send notifications
        $this->createInvoiceAndNotify($order);

        Log::info('Stripe webhook: Order marked as paid ' . $order->uuid);
    }

    private function createInvoiceAndNotify($order)
    {
        // Generate invoice PDF
        $invoice = (new Pdf())->create([
            'data' => $order,
            'view' => 'invoice',
            'name' => config('invoice.invoice_prefix') . $order->uuid,
        ]);

        // Send confirmation to customer
        try {
            Notification::route('mail', $order->email)
                ->notify(new OrderConfirmationNotification($order, $invoice));
        } catch (\Exception $e) {
            Log::error('Stripe webhook: Failed to send customer notification - ' . $e->getMessage());
        }

        // Send notification to admin
        try {
            Notification::route('mail', env('MAIL_TO'))
                ->notify(new OrderInformationNotification($order, $invoice));
        } catch (\Exception $e) {
            Log::error('Stripe webhook: Failed to send admin notification - ' . $e->getMessage());
        }
    }
}
