<x-layout--admin>
    <div class="card">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Chi tiết sản phẩm</h1>
            <a href="{{ route('menu.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Quay lại danh
                sách</a>
        </div>
        <div class="infomation">
            <div>
                <p><strong>Name:</strong> {{ $menu->name }}</p>
                <p><strong>Id:</strong> {{ $menu->id }}</p>
                <p><strong>Link:</strong> {{ $menu->link }}</p>
                <p><strong>Parent_id:</strong> {{ $menu->parent_id }}</p>
                <p><strong>sort_order:</strong> {{ $menu->sort_order }}</p>
                <p><strong>Status:</strong> {{ $menu->status }}</p>
                <p><strong>Type:</strong> {{ $menu->type }}</p>
            </div>
        </div>
    </div>
</x-layout--admin>
