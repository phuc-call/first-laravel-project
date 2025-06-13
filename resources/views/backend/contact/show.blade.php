<x-layout--admin>
    <div class="p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Chi tiết liên hệ</h2>
        <table class="table-auto w-full text-left">
            <tr>
                <th class="px-4 py-2">Họ tên</th>
                <td class="px-4 py-2">{{ $contact->name }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2">Email</th>
                <td class="px-4 py-2">{{ $contact->email }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2">Số điện thoại</th>
                <td class="px-4 py-2">{{ $contact->phone }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2">Tiêu đề</th>
                <td class="px-4 py-2">{{ $contact->title }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2">Nội dung</th>
                <td class="px-4 py-2">{{ $contact->content }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2">Phản hồi</th>
                <td class="px-4 py-2">{{ $contact->reply_id }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2">Trạng thái</th>
                <td class="px-4 py-2">
                    @if ($contact->status == 1)
                        <span class="text-green-600 font-semibold">Đã phản hồi</span>
                    @else
                        <span class="text-red-600 font-semibold">Chưa phản hồi</span>
                    @endif
                </td>
            </tr>
        </table>

        <a href="{{ route('contact.index') }}" class="inline-block mt-4 text-blue-500 hover:underline">← Quay lại danh
            sách</a>
    </div>
</x-layout--admin>
