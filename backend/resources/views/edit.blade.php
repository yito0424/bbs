<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スレッド編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('thread.update', ['id' => $thread->id]) }}">
                        @csrf

                        <div class="mt-4">
                            <x-label for="content" value="内容" />

                            <x-input id="content" class="block mt-1 w-full"
                                            type="text"
                                            name="content"
                                            value="{{ $thread->content }}" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-block items-center bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            更新する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
