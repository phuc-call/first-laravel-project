<x-layout--admin>
    <form action="{{ route('contact.update', ['contact' => $contact->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
            <div class="boder border-blue-100 mb-3 rounded-lg p-2">
                <div class="flex items-center justify-between">
                    <div class="">
                        <h2 class="text-xl font-bold text-blue-600">QUAN LÝ LIÊN HỆ</h2>
                    </div>
                    <div class="text-right">
                        <a class="bg-green-500 rounded-xl px-2 py-2 mx-1 text-white scale-75"
                            href="{{ route('contact.index') }}">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Ve danh sach
                        </a>
                    </div>
                </div>
            </div>
            <div class="border border-blue-100 rounded-lg p-2">
                <div class="flex gap-3">
                    <div class="basis-9-12">
                        <div class="mb-3">
                            <label id="name"><strong>Ten</strong></label>
                            <input type="text" value="{{ old('name', $contact->name) }}"
                                class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhap ten"
                                name="name" id="name">
                        </div>
                        <div class="mb-3">
                            <label id="email"><strong>email</strong></label>
                            <input type="email" value="{{ old('email', $contact->email) }}"
                                class="w-full border border-gray-300 rounded-lg p-2" placeholder="Nhap email"
                                name="email" id="email">
                        </div>
                        <!-- trang detal -->


                        <div class="flex justify-between gap-5">
                            <div class="mb-3">
                                <label id="phone"><strong>Phone</strong></label>
                                <input type="phone" class="w-full border border-gray-300 rounded-lg p-2"
                                    placeholder="Nhap số điện thoại " name="phone" id="phone">
                            </div>

                            <div class="mb-3">
                                <label id="title"><strong>Chủ đề</strong></label>
                                <input type="text" class="w-full border border-gray-300 rounded-lg p-2"
                                    placeholder="Nhap chủ đề" name="title" id="title">
                            </div>
                            <div class="mb-3">
                                <label id="content"><strong>Nội dung</strong></label>
                                <input type="text" class="w-full border border-gray-300 rounded-lg p-2"
                                    placeholder="Nhap nội dung" name="content" id="content">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label id="status"><strong>Trang thai</strong></label>
                    <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2">
                        <option value="1">Xuat ban</option>
                        <option value="0">Khong xuat ban</option>
                    </select>
                </div>
            </div>
            <div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    Lưu order
                </button>
            </div>
        </div>
    </form>
    <!-- bảng product -->
</x-layout--admin>
