<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Aspiration &raquo; #{{ $aspiration->id }} {{ $aspiration->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-5">
                Aspiration Details
            </h2>

            <div class="bg-white overflow-hidden shadow sm:rounded-lg mb-10">
                <div class="p-6 bg-white">
                    <table class="table-auto w-full" border="0">
                        <tbody>
                            <tr>
                                <th class=" px-6 py-4 text-left">Status</th>
                                <td>:</td>
                                <td class=" px-6 py-4">
                                    @if ($aspiration->status == 1)
                                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                                            Belum
                                        </span>
                                    @elseif ($aspiration->status == 2)
                                        <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">
                                            Proses
                                        </span>
                                    @elseif ($aspiration->status == 3)
                                        <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                                            Selesai
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Kode</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $aspiration->kode }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Lampiran</th>
                                <td>:</td>
                                <td class=" px-6 py-4">
                                    @if ($aspiration->attachment == null)
                                        Tidak ada gambar
                                    @else
                                    <img style="max-width: 150px" src="{{ Storage::url('aspiration/'.$aspiration->attachment) }}"/>
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Title</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $aspiration->title }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Slug</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $aspiration->slug }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Kategori</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $aspiration->category->name }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Pelapor</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $aspiration->user->name }}</td>
                            </tr>

                            <tr>
                                <th class=" px-6 py-4 text-left">Description</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{!! $aspiration->description !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
