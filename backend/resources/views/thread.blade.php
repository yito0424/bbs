<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スレッド詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-2xl m-4">{{ $thread->content }}</p>
                    <a href='{{ route("dashboard") }}' class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        記事一覧へ戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
