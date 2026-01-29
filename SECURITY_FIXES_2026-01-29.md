# Security Fixes - 2026-01-29

## Summary

Fixed critical payment security vulnerabilities in the checkout flow.

---

## Issues Fixed

### 1. Payment Bypass (CRITICAL)

**Problem**: The `/bestellung/zahlung-erfolgreich` endpoint was a GET request that marked orders as paid without verifying payment with Stripe. Anyone could visit the URL and get free products.

**Solution**: Implemented Stripe webhook verification.

- Orders are now created as "pending" (unpaid) before redirecting to Stripe
- A webhook receives confirmation from Stripe when payment succeeds
- Only the webhook can mark an order as paid and trigger confirmation emails

### 2. Price Manipulation (CRITICAL)

**Problem**: Prices were read from the session instead of the database. An attacker could manipulate their session to pay less.

**Solution**: All prices are now fetched from the database when creating orders and Stripe checkout sessions.

### 3. Session Security

**Already configured**:
- `'encrypt' => true` in `config/session.php`
- `'same_site' => 'strict'` in `config/session.php`

### 4. Image Path Traversal

**Problem**: The ImageController didn't validate paths, potentially allowing directory traversal attacks.

**Solution**: Added validation to reject paths containing `..` or starting with `/`.

---

## Files Created

### `app/Http/Controllers/StripeWebhookController.php`
Handles Stripe webhook events. Verifies signature, marks orders as paid, sends notifications.

### `database/migrations/2026_01_29_000001_add_stripe_session_id_to_orders_table.php`
Adds `stripe_session_id` column to orders table to link orders with Stripe checkout sessions.

---

## Files Modified

### `app/Http/Controllers/OrderController.php`
- `finalize()`: Creates pending order before Stripe redirect, stores Stripe session ID
- `paymentSuccess()`: Now just redirects to confirmation (webhook handles payment confirmation)
- `paymentCancel()`: Handles cancelled payments

### `app/Actions/Order/HandleOrder.php`
- Added `createPending()` method for creating unpaid orders
- Prices fetched from database, not session
- Removed email notifications (moved to webhook)

### `app/Models/Order.php`
- Added `stripe_session_id` to fillable
- Fixed `getPaymentInfoAttribute()` to handle pending payments gracefully

### `app/Http/Controllers/ImageController.php`
- Added path traversal protection

### `routes/web.php`
- Added `StripeWebhookController` import
- Payment success/cancel routes now require order UUID parameter
- Added `/stripe/webhook` POST route

### `app/Http/Middleware/VerifyCsrfToken.php`
- Added `stripe/webhook` to CSRF exceptions

### `config/services.php`
- Added Stripe configuration (secret, public, webhook_secret)

---

## Required Setup

### 1. Run Migration

```bash
php artisan migrate
```

### 2. Add Webhook Secret to .env

```
STRIPE_WEBHOOK_SECRET=whsec_...
```

### 3. Create Webhook in Stripe Dashboard

**Important:** Test and Live modes have separate webhooks with different signing secrets.

**For each environment (test/staging and production):**
1. Make sure you're in the correct mode (Test/Live toggle in Stripe Dashboard)
2. Go to **Developers > Webhooks > Add endpoint**
3. Endpoint URL: `https://yourdomain.com/stripe/webhook`
4. Select event: `checkout.session.completed`
5. Copy the signing secret to your `.env` as `STRIPE_WEBHOOK_SECRET`

Each webhook endpoint has its own unique signing secret - test and live secrets are different.

### 4. Verify Production .env

```
APP_DEBUG=false
APP_ENV=production
SESSION_SECURE_COOKIE=true
```

---

## How It Works Now

1. User completes checkout form and clicks "Pay"
2. `OrderController::finalize()` creates a **pending order** (unpaid) in the database
3. User is redirected to Stripe Checkout
4. After payment, Stripe redirects user to `/bestellung/zahlung-erfolgreich/{order}`
5. User sees confirmation page (order may still show "processing")
6. Stripe sends webhook to `/stripe/webhook`
7. `StripeWebhookController` verifies signature, marks order as paid, sends emails
8. If user refreshes confirmation page, they see the completed payment info
