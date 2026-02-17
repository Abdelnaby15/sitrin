<x-mail::message>
# Good News! {{ $product->name }} is Back in Stock

We're excited to let you know that **{{ $product->name }}** is now available again!

## Product Details

- **Price:** EGP {{ number_format($product->price, 2) }}
@if($product->size)
- **Size:** {{ $product->size }}
@endif
- **Availability:** In Stock Now

Don't miss out - this popular item may sell out quickly!

<x-mail::button :url="route('products.show', $product->slug)">
View Product
</x-mail::button>

---

<small>You received this email because you signed up for stock notifications for this product.</small>

<small>[Click here]({{ route('stock-notifications.unsubscribe', $unsubscribeToken) }}) to unsubscribe from these notifications.</small>

Thank you for shopping with SITRIN!

Regards,<br>
{{ config('app.name') }}
</x-mail::message>
