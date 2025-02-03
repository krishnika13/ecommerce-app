@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Orders</h1>

        @foreach ($orders as $order)
            <div class="order">
                <p>Order ID: {{ $order->id }}</p>
                <p>Status: {{ $order->status }}</p>
                <p>Total Price: ${{ $order->total_price }}</p>
                <!-- Add other order details here -->
            </div>
        @endforeach
    </div>
@endsection
