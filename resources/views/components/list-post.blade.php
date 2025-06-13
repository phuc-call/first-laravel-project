<div class="w-full bg-white p-8">
    <div class="text-red-500 font-bold text-xl mb-4">🔥 Chương trình khuyến mãi hot</div>
    <ul class="space-y-4 flex flex-wrap justify-evenly gap-6">
        @foreach ($post_list as $post_row)
            <li class="flex items-center">
                <div class="w-16 h-16 rounded-md overflow-hidden mr-4">
                    <img src="{{ asset('assets/thumbnail/post/' . $post_row->thumbnail) }}" alt="Free Shipping"
                        class="w-full h-full object-cover" />
                </div>
                <div>
                    <div class="font-semibold">{{ $post_row->title }}</div>
                    <div class="text-gray-500 text-sm">{{ $post_row->description }}</div>
                </div>
            </li>
        @endforeach

    </ul>
    <button class="text-blue-500 font-semibold mt-6">Xem tất cả</button>
</div>
</div>
