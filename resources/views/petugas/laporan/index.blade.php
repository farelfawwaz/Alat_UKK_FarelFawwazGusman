@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

@section('content')

    {{-- HEADER --}}
    <div class="mb-8 flex justify-between items-start print:hidden">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Laporan Peminjaman & Pengembalian
            </h1>
            <p class="text-gray-500 mt-2">
                Pilih data yang ingin dicetak
            </p>
        </div>

        <button onclick="cetakTerpilih()" class="px-4 py-2 bg-gray-800 text-white rounded-lg">
            Cetak Terpilih
        </button>
    </div>

    {{-- TABEL (LAYAR SAJA) --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden print:hidden">
        <table class="w-full text-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-center">
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th class="px-6 py-4">Peminjam</th>
                    <th class="px-6 py-4">Alat</th>
                    <th class="px-6 py-4 text-center">Tgl Pinjam</th>
                    <th class="px-6 py-4 text-center">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach ($laporan as $item)
                    <tr>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" class="print-check">
                        </td>
                        <td class="px-6 py-4 text-center">{{ $item->nama_peminjam ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">{{ $item->alat->nama_alat ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $statusClass = match ($item->status) {
                                    'menunggu' => 'bg-yellow-100 text-yellow-700',
                                    'dipinjam' => 'bg-blue-100 text-blue-700',
                                    'dikembalikan' => 'bg-green-100 text-green-700',
                                    'ditolak' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp

                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                {{ strtoupper($item->status) }}
                            </span>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- AREA CETAK --}}
    <div id="printArea" class="hidden print:block"></div>

    {{-- SCRIPT --}}
    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            document.querySelectorAll('.print-check').forEach(cb => cb.checked = this.checked)
        })

        function cetakTerpilih() {
            const printArea = document.getElementById('printArea')
            printArea.innerHTML = ''

            const checked = document.querySelectorAll('.print-check:checked')

            if (checked.length === 0) {
                alert('Pilih minimal 1 data')
                return
            }

            checked.forEach(cb => {
                const row = cb.closest('tr')

                const peminjam = row.children[1].innerText
                const alat = row.children[2].innerText
                const tanggal = row.children[3].innerText
                const status = row.children[4].innerText

                printArea.innerHTML += `
            <div class="print-page">
                <h2 style="font-size:18px;margin-bottom:20px;text-align:center;">
                    LAPORAN PEMINJAMAN / PENGEMBALIAN
                </h2>

                <table border="1" width="100%" cellpadding="10" cellspacing="0">
                    <tr>
                        <td width="30%"><strong>Peminjam</strong></td>
                        <td>${peminjam}</td>
                    </tr>
                    <tr>
                        <td><strong>Alat</strong></td>
                        <td>${alat}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Pinjam</strong></td>
                        <td>${tanggal}</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td><strong>${status}</strong></td>
                    </tr>
                </table>

                <div style="margin-top:60px;text-align:right;">
                    <p>Petugas</p><br><br>
                    <strong>{{ auth()->user()->name }}</strong>
                </div>
            </div>
        `
            })

            window.print()
        }
    </script>


    {{-- STYLE PRINT --}}
    <style>
        @media print {
            .print-page {
                page-break-after: always;
                padding: 20px;
            }
        }
    </style>

@endsection
