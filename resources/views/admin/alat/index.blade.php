    @extends('layouts.app')

    @section('title', 'Manajemen Alat')

    @section('content')

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg> Manajemen Alat
                    </h1>
                    <p class="text-gray-500 mt-2">Kelola data alat dan ketersediaannya</p>
                </div>

                <a href="{{ route('admin.alat.create') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg shadow hover:shadow-xl transition transform hover:scale-105">
                    <!-- Plus Icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Alat
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-center">Image</th>
                            <th class="px-6 py-4 text-left">Alat</th>
                            <th class="px-6 py-4 text-center">Kode</th>
                            <th class="px-6 py-4 text-center">Kategori</th>
                            <th class="px-6 py-4 text-center">Stok</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($alats as $alat)
                            <tr class="hover:bg-blue-50 transition">
                                <!-- No -->
                                <td class="px-6 py-4">
                                    <span
                                        class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 font-semibold text-gray-700">
                                        {{ $alats->firstItem() + $loop->index }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($alat->image)
                                        <img src="{{ asset('storage/' . $alat->image) }}"
                                            class="w-14 h-14 object-cover rounded-lg mx-auto">
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>

                                <!-- Nama Alat -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $alat->nama_alat }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Kode -->
                                <td class="px-6 py-4 text-center font-mono">
                                    {{ $alat->kode_alat }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $alat->kategori->name ?? '-' }}
                                </td>


                                <!-- Stok -->
                                <td class="px-6 py-4 text-center font-semibold">
                                    {{ $alat->stok }}
                                </td>

                                <!-- Status -->
                                <td class="px-4 py-2 text-center">
                                    {{ ucfirst($alat->status) }}
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.alat.edit', $alat->id) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-white text-blue-500 rounded-lg shadow hover:shadow-lg transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2">
                                                    <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                    <path
                                                        d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                                </g>
                                            </svg>
                                            Edit
                                        </a>

                                        <!-- Hapus -->
                                        <form action="{{ route('admin.alat.destroy', $alat->id) }}" method="POST"
                                            class="form-delete">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center gap-2 px-4 py-2
        bg-white text-red-500 rounded-lg shadow
        hover:shadow-lg transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="m18.412 6.5l-.801 13.617A2 2 0 0 1 15.614 22H8.386a2 2 0 0 1-1.997-1.883L5.59 6.5H3.5v-1A.5.5 0 0 1 4 5h16a.5.5 0 0 1 .5.5v1z" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="text-5xl mb-4">📦</div>
                                    <p class="text-gray-500 font-medium text-lg">Belum ada data alat</p>
                                    <p class="text-gray-400 text-sm">Silakan tambahkan alat baru</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $alats->links() }}
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
