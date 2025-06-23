<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            フォーム
        </h2>
    </x-slot>
    <x-message :message="session('message')"/>
    <div class="max-w-7xl mx-auto px-6">
        <form action="{{route('post.store')}}" method="POST" id="postForm">
            @csrf
            <div class="mt-8">
                <div class="w-full flex flex-col">
                    <label for="title" class="font-semibold mt-4">件名</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <input id="title" type="text" name="title" class="w-auto py-2 border border-gray-300 rounded-md" value="{{old('title')}}">
                    <p id="titleError" class="text-red-500 text-sm mt-1"></p>
                </div>
            </div>

                <div class="w-full flex flex-col">
                    <label for="body" class="font-semibold mt-4">本文</label>
                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    <textarea name="body" id="body" cols="30" rows="5" class="w-auto py-2 border border-gray-300 rounded-md" value="{{old('body')}}"></textarea>
                    <p id="bodyError" class="text-red-500 text-sm mt-1"></p>
                    <div class="text-right text-sm text-gray-500 mt-2">
                        <span id="charCount">0</span>/<span id="maxChars">400</span>文字
                    </div>
                </div>

                <x-primary-button class="mt-4">
                    送信する
                </x-primary-button>
        </form>
    </div>
        @push('scripts')
            <script src="{{ asset('js/post/main.js') }}"></script>
        @endpush
</x-app-layout>