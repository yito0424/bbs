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
                    <p class="text-2xl mt-4">{{ $thread->content }}</p>
                    <p>投稿者：{{ $thread->user->name }}</p>
                    @foreach ($replies as $reply)
                        <p class="text-xl mt-4 ml-4">{{ $reply->content }}</p>
                        <div class="ml-4 mb-4">投稿者：{{ $reply->user->name }}
                            @auth
                                @if (Auth::user()->id == $reply->user->id || Auth::user()->role == 'admin')
                                    | <a href='{{ route("reply.edit", ["rep_id" => $reply->id]) }}'>編集</a>
                                    <form method="POST" action='{{ route("reply.destroy", ["rep_id" => $reply->id]) }}'>
                                        @csrf
                                        <input type="hidden" name="_method" value="delete">
                                        <input type="submit" class="inline-block items-center border-2 border-red-400 bg-red-100 text-red-400 hover:bg-red-400 hover:text-white text-white font-bold py-2 px-4 rounded" value="削除">
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                    <form method="POST" action='{{ route("reply.store", ["id" => $thread->id]) }}'>
                        @csrf

                        <div class="mt-4">
                            <x-label for="content" value="内容" />

                            <x-input id="content" class="block mt-1 w-full"
                                            type="text"
                                            name="content" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-block items-center bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            スレッドに返信する
                            </button>
                        </div>
                    </form>
                    <div class="flex items-center justify-end mt-4">
                        <a href='{{ route("dashboard") }}' class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            記事一覧へ戻る
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
