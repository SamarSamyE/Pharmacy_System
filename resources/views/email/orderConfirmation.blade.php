<x-mail::message>
# Order Shipped

Your order has been shipped!

<x-mail::button :url="$confirmUrl">
Confirm Order
</x-mail::button>

<x-mail::button :url="$cancelUrl">
Cancel Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>


