<x-mail::message>
# Order Confirmation

Thank you for your order, **{{ $order->shipping_name }}**!

Your order #{{ $order->id }} has been received and is being processed.

## Order Details

<x-mail::table>
| Product | Quantity | Price |
|:--------|:---------|:------|
@foreach($order->items as $item)
| {{ $item->product_name }} @if($item->size)({{ $item->size }})@endif | {{ $item->quantity }} | EGP {{ number_format($item->subtotal, 2) }} |
@endforeach
</x-mail::table>

**Subtotal:** EGP {{ number_format($order->subtotal, 2) }}  
**Shipping:** EGP {{ number_format($order->shipping_cost, 2) }}  
**Total:** EGP {{ number_format($order->total, 2) }}

## Shipping Address

{{ $order->shipping_address }}  
{{ $order->shipping_city }}, {{ $order->shipping_country }}  
{{ $order->shipping_phone }}

## Payment Method

{{ $order->payment_method == 'cash_on_delivery' ? 'Cash on Delivery' : 'Instapay on Delivery' }}

<x-mail::button :url="route('orders.track', $order->id)">
Track Your Order
</x-mail::button>

If you have any questions, please don't hesitate to contact us.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
