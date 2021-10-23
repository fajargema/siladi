<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengaduan &raquo; #{{ $complaint->id }} {{ $complaint->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-5">
                Detail Pengaduan
            </h2>

            <div class="bg-white overflow-hidden shadow sm:rounded-lg mb-10">
                <div class="p-6 bg-white">
                    <table class="table-auto w-full" border="0">
                        <tbody>
                            @if ($complaint->status == 1)
                                <form class="inline-block" action="{{ route('dashboard.proses-pen', $complaint->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                                            <i class="bx bx-recycle"></i> Proses
                                    </button>
                                </form>
                            @elseif ($complaint->status == 2)
                                <form class="inline-block" action="{{ route('dashboard.selesai-pen', $complaint->id) }}" method="POST">
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
                                    @if ($complaint->attachment == null)
                                        Tidak ada gambar
                                    @else
                                    <img style="max-width: 500px" src="{{ Storage::url('complaint/'.$complaint->attachment) }}"/>
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Status</th>
                                <td>:</td>
                                <td class=" px-6 py-4">
                                    @if ($complaint->status == 1)
                                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                                            Belum
                                        </span>
                                    @elseif ($complaint->status == 2)
                                        <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">
                                            Proses
                                        </span>
                                    @elseif ($complaint->status == 3)
                                        <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                                            Selesai
                                        </span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th class=" px-6 py-4 text-left">Kode Pengaduan</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $complaint->kode }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Judul Pengaduan</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $complaint->title }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Kategori Pengaduan</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $complaint->category->name }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Jenis Laporan</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $complaint->type->name }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Tanggal Kejadian</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $fdate }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Lokasi Kejadian</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{{ $complaint->location }}</td>
                            </tr>
                            <tr>
                                <th class=" px-6 py-4 text-left">Nama Pelapor</th>
                                <td>:</td>
                                <td class=" px-6 py-4">
                                    @if ($complaint->privacy == 1)
                                        {{ $complaint->user->name }}
                                    @elseif ($complaint->privacy == 2)
                                        {{ $result = substr($complaint->user->name, 0, 1) . preg_replace('/[^@]/', '*', substr($complaint->user->name, 1)) }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th class=" px-6 py-4 text-left">Isi Pengaduan</th>
                                <td>:</td>
                                <td class=" px-6 py-4">{!! $complaint->description !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
