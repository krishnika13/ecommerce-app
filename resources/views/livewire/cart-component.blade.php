<div>
    <h2>Your Cart</h2>

    @forelse($cart as $item)
        <p>{{ $item->product->name }} - Quantity: {{ $item->quantity }} - Price: ${{ $item->product->price }}</p>
    @empty
        <p>Your cart is empty.</p>
    @endforelse

    <p>Total: ${{ collect($cart)->sum(fn($item) => $item->product->price * $item->quantity) }}</p>
</div>
