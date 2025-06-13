<x-layout--admin>
    <div class="container">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Chi tiết user</h1>
            <a href="{{ route('user.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Quay lại danh sách</a>
        </div>
    </div>
    <div>
        <p><strong>Id:</strong>{{ $user->id }}</p>
        <p><strong>Name:</strong>{{ $user->name }}</p>
        <p><strong>userName:</strong>{{ $user->username }}</p>
        <p><strong>email:</strong>{{ $user->email }}</p>
        <p><strong>phone:</strong>{{ $user->phone }}</p>

        <p><strong>status:</strong>{{ $user->status }}</p>
    </div>
</x-layout--admin>
