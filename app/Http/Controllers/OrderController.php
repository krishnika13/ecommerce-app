<?php



namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show the checkout page
    public function showCheckoutForm($productId)
    {
        $product = Product::findOrFail($productId);
        return view('checkout', compact('product'));
    }

    // Process the checkout form
    public function processCheckout(Request $request, $productId)
    {
        // Validate payment details (you can add more validation here)
        $validated = $request->validate([
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string',
            'address' => 'required|string',
        ]);

        // Find the product
        $product = Product::findOrFail($productId);

        // Save the order details to the database
        $order = new Order();
        $order->product_id = $productId;
        $order->user_id = auth()->user()->id; // Assuming user is authenticated
        $order->total_price = $product->price;  // Set the total price based on the product's price
        $order->status = 'pending'; // Set the initial status as pending
        $order->card_number = $validated['card_number']; // Save the payment details (you can encrypt them for security)
        $order->expiry_date = $validated['expiry_date'];
        $order->cvv = $validated['cvv'];
        $order->address = $validated['address'];
        $order->save();

        // You could also add payment gateway integration here to process payments

        return redirect()->route('orders.index')->with('message', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = Order::all(); // Get all orders from the database
        return view('orders.index', compact('orders')); // Pass orders to the view
    }
}
