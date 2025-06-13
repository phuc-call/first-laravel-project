<x-layout--admin>
    <div class="container">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Chi tiết</h1>
            <a href="{{ route('order.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Quay lại danh sách</a>
        </div>
    </div>
    <div>
        <p><strong>Id:</strong>{{ $order->id }}</p>
        <p><strong>Name:</strong>{{ $order->name }}</p>
        <p><strong>User_id:</strong>{{ $order->user_id }}</p>
        <p><strong>status:</strong>{{ $order->status }}</p>
        <p><strong>phone:</strong>{{ $order->phone }}</p>
        <p><strong>email:</strong>{{ $order->email }}</p>
        <p><strong>address:</strong>{{ $order->address }}</p>
    </div>
</x-layout--admin>  
