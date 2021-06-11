<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スレッド一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($threads as $thread)
                        <p class="py-2">
                            <a href='{{ route("thread.show", ["id" => $thread->id]) }}' class="text-2xl">
                                {{ $thread->content }}
                            </a><br>
                            投稿者：{{ $thread->user->name }}
                            @auth
                                @if (Auth::user()->id == $thread->user->id)
                                 | <a href='{{ route("thread.edit", ["id" =>  $thread->id]) }}'>編集</a>
                                <form method="POST" action='{{ route("thread.destroy", ["id" => $thread->id]) }}'>
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="submit" class="inline-block items-center border-2 border-red-400 bg-red-100 text-red-400 hover:bg-red-400 hover:text-white text-white font-bold py-2 px-4 rounded" value="削除">
                                </form>
                                @endif
                            @endauth
                        </p>
                    @endforeach
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route("thread.create") }}" type="submit" class="inline-block items-center bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            新規投稿
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
