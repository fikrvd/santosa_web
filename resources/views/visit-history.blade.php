@extends('layouts.app')

@section('title', 'Riwayat Kunjungan')

@section('header', 'Riwayat Kunjungan')


@section('content')


    <div class="mb-6">

        <a href="{{ route('patients.show', $medical_record_no) }}" class="text-sm text-blue-700 hover:underline">

            ← Kembali ke Detail Pasien

        </a>


        <h2 class="mt-5 text-2xl font-semibold tracking-tight">
            Riwayat Kunjungan Pasien
        </h2>


        <p class="mt-2 text-sm text-slate-500">
            Daftar riwayat kunjungan berdasarkan nomor rekam medis pasien.
        </p>


    </div>





    <!-- Summary Pasien -->

    <section class="rounded-xl border border-slate-200 bg-white p-6">


        <div class="grid gap-6 md:grid-cols-4">



            <div>

                <p class="text-sm text-slate-500">
                    Nomor Rekam Medis
                </p>

                <p class="mt-1 font-semibold">
                    {{ $patient['medical_record_no'] ?? $medical_record_no }}
                </p>

            </div>





            <div>

                <p class="text-sm text-slate-500">
                    Nama Pasien
                </p>

                <p class="mt-1 font-semibold">
                    {{ $patient['name'] ?? '-' }}
                </p>

            </div>





            <div>

                <p class="text-sm text-slate-500">
                    Total Kunjungan
                </p>

                <p class="mt-1 text-xl font-semibold">
                    {{ $summary['total_visit'] ?? 0 }}
                </p>

            </div>





            <div>

                <p class="text-sm text-slate-500">
                    Kunjungan Terakhir
                </p>

                <p class="mt-1 font-semibold">
                    {{ !empty($summary['last_visit'])
        ? substr($summary['last_visit'], 0, 10)
        : '-' }}
                </p>

            </div>



        </div>


    </section>








    <!-- Table -->

    <section class="mt-6 overflow-hidden rounded-xl border border-slate-200 bg-white">


        <div class="border-b border-slate-200 px-6 py-5">

            <h3 class="font-semibold">
                Data Kunjungan
            </h3>

        </div>





        <div class="overflow-x-auto">


            <table class="w-full min-w-[700px] text-sm">


                <thead class="bg-slate-100 text-slate-600">


                    <tr>


                        <th class="px-6 py-3 text-left font-medium">
                            No. Kunjungan
                        </th>


                        <th class="px-6 py-3 text-left font-medium">
                            Tanggal
                        </th>


                        <th class="px-6 py-3 text-left font-medium">
                            Tipe
                        </th>


                        <th class="px-6 py-3 text-left font-medium">
                            Status
                        </th>


                        <th class="px-6 py-3 text-left font-medium">
                            Keluhan
                        </th>


                    </tr>


                </thead>





                <tbody class="divide-y divide-slate-100">


                    @forelse($visits as $visit)


                                <tr class="hover:bg-slate-50">


                                    <td class="px-6 py-4 font-medium">

                                        {{ $visit['visit_no'] ?? '-' }}

                                    </td>




                                    <td class="px-6 py-4">

                                        {{ !empty($visit['visit_date'])
                        ? substr($visit['visit_date'], 0, 19)
                        : '-' }}

                                    </td>





                                    <td class="px-6 py-4">

                                        {{ $visit['visit_type'] ?? '-' }}

                                    </td>





                                    <td class="px-6 py-4">


                                        @if(($visit['status'] ?? '') == 'COMPLETED')

                                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">

                                                COMPLETED

                                            </span>


                                        @elseif(($visit['status'] ?? '') == 'CANCELLED')


                                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">

                                                CANCELLED

                                            </span>



                                        @elseif(($visit['status'] ?? '') == 'IN_PROGRESS')


                                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">

                                                IN_PROGRESS

                                            </span>



                                        @else


                                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">

                                                {{ $visit['status'] ?? '-' }}

                                            </span>


                                        @endif


                                    </td>






                                    <td class="px-6 py-4">

                                        {{ $visit['complaint'] ?? '-' }}

                                    </td>



                                </tr>



                    @empty


                        <tr>

                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">

                                Tidak ada riwayat kunjungan.

                            </td>

                        </tr>


                    @endforelse



                </tbody>



            </table>


        </div>







        <!-- Pagination -->

        <div class="flex items-center justify-between border-t border-slate-200 px-6 py-4">


            <span class="text-sm text-slate-500">

                Halaman {{ $page }} dari {{ $lastPage }}

            </span>




            <div class="flex gap-2">



                @if($page > 1)


                    <a href="{{ request()->fullUrlWithQuery(['page' => $page - 1]) }}"
                        class="rounded-lg border px-3 py-2 text-sm hover:bg-slate-50">

                        ← Sebelumnya

                    </a>


                @endif





                @if($page < $lastPage)


                    <a href="{{ request()->fullUrlWithQuery(['page' => $page + 1]) }}"
                        class="rounded-lg border px-3 py-2 text-sm hover:bg-slate-50">

                        Berikutnya →

                    </a>


                @endif



            </div>


        </div>






    </section>



@endsection