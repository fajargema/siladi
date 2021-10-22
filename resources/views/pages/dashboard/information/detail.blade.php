<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Permintaan Informasi &raquo; #{{ $information->id }} {{ $information->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-5">
                Detail Permintaan Informasi
            </h2>

            <div class="bg-white overflow-hidden shadow sm:rounded-lg mb-10">
                <div class="p-6 bg-white">
                    <table class="table-auto w-full" border="0">
                        <tbody>
                            @if ($information->status == 1)
                                <form class="inline-block" action="{{ route('dashboard.proses-inf', $information->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                                            <i class="bx bx-recycle"></i> Proses
                                    </button>
                                </form>
                            @elseif ($information->status == 2)
                                <form class="inline-block" action="{{ route('dashboard.selesai-inf', $information->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="bg-green-600 hover:bg-green-800 text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                                            <i class="bx bx-transfer-alt"></i> Selesai
                                    </button>
                                </form>
                            @endif
                            <tr>
                                <th class=" px-6 py-4 text-left">Lampiran</th>
                                <td>:</td>
                                <td class=" px-6 py-4">
                                    @if ($information->attachment == null)
                                        Tidak ada gambar
                                    @else
                                    <img style="max-width: 500px" src="{{ Storage::url('information/'.$information->attachment) }}"/>
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Status</th>
                                <td>:</td>
                                <td class=" px-6 py-4">
                                    @if ($information->status == 1)
                                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                                            Belum
                                        </span>
                                    @elseif ($information->status == 2)
                                        <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">
                                            Proses
                                        </span>
                                    @elseif ($information->status == 3)
                                        <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                                            Selesai
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Kode Permintaan Informasi</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $information->kode }}</td>
                            </tr>

                            <tr>
                                <th class=" px-6 py-4 text-left">Judul Permintaan Informasi</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $information->title }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Kategori Permintaan Informasi</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $information->category->name }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Nama Pelapor</th>
                                <td>:</td>
                                <td class=" px-6 py-4">
                                    @if ($information->privacy == 1)
                                        {{ $information->user->name }}
                                    @elseif ($information->privacy == 2)
                                        {{ $result = substr($information->user->name, 0, 1) . preg_replace('/[^@]/', '*', substr($information->user->name, 1)) }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th class=" px-6 py-4 text-left">Isi Permintaan Informasi</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{!! $information->description !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
