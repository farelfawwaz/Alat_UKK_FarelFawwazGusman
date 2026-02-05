@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                    <svg class="w-10 h-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" d="M3 7h6l2 3h10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    </svg>
                    Manajemen Kategori
                </h1>
                <p class="text-gray-500 mt-2">
                    Kelola kategori alat agar data lebih terstruktur
                </p>
            </div>

            <a href="{{ route('kategori.create') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105">

                Tambah Kategori
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white">
                        <th class="w-16 px-6 py-4 text-center">No</th>
                        <th class="w-56 px-6 py-4 text-left">Nama Kategori</th>
                        <th class="px-6 py-4 text-left">Deskripsi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($kategori as $item)
                        <tr class="group relative hover:bg-indigo-50 transition duration-200">

                            <!-- No -->
                            <td class="px-6 py-4 text-center align-middle">
                                <div
                                    class="w-8 h-8 mx-auto flex items-center justify-center rounded-full bg-gray-200 font-semibold">
                                    {{ $loop->iteration }}
                                </div>
                            </td>

                            <!-- Nama -->
                            <td class="px-6 py-4 font-semibold text-gray-800 align-middle">
                                {{ $item->name }}
                            </td>

                            <!-- Deskripsi -->
                            <td class="px-6 py-4 text-gray-600 leading-relaxed break-words align-middle pr-32">
                                {{ $item->deskripsi ?? '-' }}
                            </td>

                            <!-- Hover Action (Absolute Right) -->
                            <!-- Edit (Top Right Quarter Circle) -->
                            <td
                                class="absolute top-0 right-0
           opacity-0 group-hover:opacity-100
           transition duration-300">

                                <a href="{{ route('kategori.edit', $item->id) }}"
                                    class="w-10 h-10 flex items-center justify-center
               bg-white text-blue-500 text-xs font-semibold
               rounded-bl-2xl shadow-lg
               hover:bg-gray-300 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path
                                                d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                        </g>
                                    </svg>
                                </a>
                            </td>

                            <!-- Hapus (Bottom Right Quarter Circle) -->
                            <td
                                class="absolute bottom-0 right-0
           opacity-0 group-hover:opacity-100
           transition duration-300">

                                <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="w-10 h-10 flex items-center justify-center
               bg-white text-red-500 text-xs font-semibold
               rounded-bl-2xl shadow-lg
               hover:bg-gray-300 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="m18.412 6.5l-.801 13.617A2 2 0 0 1 15.614 22H8.386a2 2 0 0 1-1.997-1.883L5.59 6.5H3.5v-1A.5.5 0 0 1 4 5h16a.5.5 0 0 1 .5.5v1z" />
                                        </svg>
                                
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-12 text-center text-gray-500">
                                Belum ada data kategori
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin hapus data?',
                    text: 'Data yang dihapus tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

@endsection
