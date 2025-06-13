<div class="bg-white py-8">
    <div class="px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Tin tức mới nhất</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($topic_list as $topic_row)
                <div class="bg-white shadow-md rounded-md overflow-hidden">

                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 mb-2">{{ $topic_row->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3">{{ $topic_row->description }}</p>
                        <a href="#"
                            class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full text-sm">Đọc
                            tiếp</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
