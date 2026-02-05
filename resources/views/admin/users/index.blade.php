@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')

    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                    <!-- Users Icon -->
                    <svg class="w-10 h-10 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </g>
                    </svg>
                    Manajemen Pengguna
                </h1>
                <p class="text-gray-500 mt-2">Kelola dan pantau data pengguna sistem dengan mudah</p>
            </div>

            <a href="{{ route('users.create') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105">
                <!-- Plus Icon -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pengguna
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden ">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Pengguna</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Role</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($users as $user)
                        <tr class="hover:bg-blue-50">
                            <td class="px-6 py-4">
                                <span
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 font-semibold">
                                    {{ $loop->iteration }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <!-- Status Dot -->
                                        <span
                                            class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $user->name }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:underline">
                                    {{ $user->email }}
                                </a>
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold
                            {{ $user->role === 'admin' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                                    <span
                                        class="w-2 h-2 rounded-full {{ $user->role === 'admin' ? 'bg-green-600' : 'bg-gray-500' }}"></span>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <!-- Edit -->
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-white text-blue-500 shadow rounded-lg hover:scale-105 transition">
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

                                    <!-- Delete -->
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus user ini?')"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-white text-red-500 shadow rounded-lg hover:scale-105 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="m18.412 6.5l-.801 13.617A2 2 0 0 1 15.614 22H8.386a2 2 0 0 1-1.997-1.883L5.59 6.5H3.5v-1A.5.5 0 0 1 4 5h16a.5.5 0 0 1 .5.5v1zM10 2.5h4a.5.5 0 0 1 .5.5v1h-5V3a.5.5 0 0 1 .5-.5M9 9l.5 9H11l-.4-9zm4.5 0l-.5 9h1.5l.5-9z" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center">
                                <!-- Inbox Icon -->
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0l-3 5H7l-3-5m16 0H4" />
                                </svg>
                                <p class="text-gray-500 font-medium">Belum ada data pengguna</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
