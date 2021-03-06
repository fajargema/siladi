<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Aspirasi &raquo; Buat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            There's something wrong!
                        </div>
                        <div class="border border-t0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @endif

                <form action=" {{ route('dashboard.aspiration.store') }}" class="w-full" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="types_id" value="2">

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="title" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Judul Aspirasi</label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Ketik Judul Aspirasi Anda" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Isi Aspirasi</label>
                            <textarea name="description" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{!! old('description') !!}</textarea>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="location" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Asal Pelapor</label>
                            <input type="text" name="location" value="{{ old('location') }}" placeholder="Ketik Asal Pelapor" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Kategori Aspirasi</label>
                            <select name="categories_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option>-----Pilih Kategori Aspirasi Anda-----</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="mb-3">

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="attachment" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Upload Lampiran</label>
                            <input type="file" name="attachment" accept="image" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="privacy" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Privasi</label>
                            <input type="hidden" name="privacy" value="1">
                            <input type="radio" value="2" name="privacy"> Anonim
                            <input type="radio" value="3" name="privacy"> Rahasia

                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-10 rounded shadow-lg float-right">
                                Lapor!
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
</x-app-layout>
