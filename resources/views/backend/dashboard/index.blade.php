<x-layout--admin>
    <div class="basis-4/5 bg-white ml-3 rounded-sm h-full">
        <div class="menufd">
            <div class="menu flex justify-between">
                <div class="title m-4 text-blue-500 font-[500] text-2xl">Tiêu đề</div>
                <div class="update-delete flex">
                    <a class="bg-green-500 rounded-xl mr-2 scale-75" href="fb">
                        <div>
                            <div class="updata m-4 font-[500] text-2xl text-white"><i class="fas fa-plus-square"></i> Thêm</div>
                        </div>
                    </a>
                    <a class="bg-red-500 rounded-xl mr-2 scale-75" href="">
                        <div>
                            <div class="delete m-4 font-[500] text-2xl text-white"><i class="fas fa-trash"></i> Thùng rác</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- bảng product -->
        <div class="table w-full mt-3">
            <table class="table-auto border-collapse border border-gray-400 w-full">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="border border-gray-500 px-4 py-2">GT</th>
                        <th class="border border-gray-500 px-4 py-2">GT</th>
                        <th class="border border-gray-500 px-4 py-2">GT</th>
                        <th class="border border-gray-500 px-4 py-2">GT</th>
                        <th class="border border-gray-500 px-4 py-2">GT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-gray-100 hover:bg-gray-200">
                        <td class="border border-gray-500 px-4 py-2"></td>
                        <td class="border border-gray-500 px-4 py-2">TC</td>
                        <td class="border border-gray-500 px-4 py-2">TC</td>
                        <td class="border border-gray-500 px-4 py-2">TC</td>
                        <td class="border border-gray-500 px-4 py-2">TC</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layout--admin>