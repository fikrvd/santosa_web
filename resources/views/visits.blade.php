@extends('layouts.app')

@section('title', 'Daftar Kunjungan')

@section('header', 'Data Kunjungan')


@section('content')


    <div class="mb-6">

        <h2 class="text-2xl font-semibold">
            Daftar Kunjungan
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Menampilkan data kunjungan pasien dari REST API.
        </p>

    </div>



    <section class="rounded-lg border border-slate-200 bg-white p-6">


        <h3 class="mb-5 font-semibold">
            Filter Kunjungan
        </h3>



        <form method="GET" class="grid gap-4 md:grid-cols-4">


            <div>
                <label class="mb-1 block text-sm font-medium">
                    Dari tanggal
                </label>

                <input type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}"
                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">
            </div>



            <div>
                <label class="mb-1 block text-sm font-medium">
                    Sampai tanggal
                </label>

                <input type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}"
                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">
            </div>



            <div>
                <label class="mb-1 block text-sm font-medium">
                    Status
                </label>

                <select name="status" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">

                    <option value="">
                        Semua Status
                    </option>


                    @foreach(['REGISTERED', 'IN_PROGRESS', 'COMPLETED', 'CANCELLED'] as $status)

                        <option value="{{ $status }}" @selected(($filters['status'] ?? '') == $status)>
                            {{ $status }}
                        </option>

                    @endforeach


                </select>

            </div>




            <div>

                <label class="mb-1 block text-sm font-medium">
                    Tipe Kunjungan
                </label>


                <select name="visit_type" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">

                    <option value="">
                        Semua Tipe
                    </option>


                    @foreach(['NEW', 'OLD'] as $type)

                        <option value="{{ $type }}" @selected(($filters['visit_type'] ?? '') == $type)>
                            {{ $type }}
                        </option>

                    @endforeach


                </select>


            </div>



            <div class="md:col-span-4 flex gap-3">


                <input type="hidden" name="per_page" value="15">


                <button type="submit"
                    class="rounded-md bg-blue-700 px-5 py-2 text-sm font-medium text-white hover:bg-blue-800">
                    Filter
                </button>



                <a href="{{ route('visits.index') }}"
                    class="rounded-md border border-slate-300 px-5 py-2 text-sm hover:bg-slate-50">
                    Reset
                </a>


            </div>


        </form>


    </section>





    <section class="mt-6 overflow-hidden rounded-lg border border-slate-200 bg-white">


        <div class="border-b border-slate-200 px-6 py-5">

            <h3 class="font-semibold">
                Data Kunjungan
            </h3>

        </div>



        <div class="overflow-x-auto">


            <table class="w-full text-left text-sm">


                <thead class="bg-slate-100 text-slate-600">


                    <tr>

                        <th class="px-6 py-3 font-medium">
                            No. Kunjungan
                        </th>


                        <th class="px-6 py-3 font-medium">
                            Tanggal
                        </th>


                        <th class="px-6 py-3 font-medium">
                            Status
                        </th>


                        <th class="px-6 py-3 font-medium">
                            Tipe
                        </th>


                        <th class="px-6 py-3 font-medium">
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
                                {{ $visit['visit_date'] ?? '-' }}
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
                                {{ $visit['visit_type'] ?? '-' }}
                            </td>



                            <td class="px-6 py-4">
                                {{ $visit['complaint'] ?? '-' }}
                            </td>



                        </tr>


                    @empty


                        <tr>

                            <td colspan="5" class="px-6 py-10 text-center text-slate-500">

                                Tidak ada data kunjungan.

                            </td>

                        </tr>


                    @endforelse



                </tbody>


            </table>


        </div>





        <div class="flex items-center justify-between border-t border-slate-200 px-6 py-4">


            <p class="text-sm text-slate-500">

                Halaman {{ $page ?? ($meta['current_page'] ?? request('page', 1)) }}
                dari
                {{ $lastPage ?? ($meta['last_page'] ?? 1) }}

            </p>



            <div class="flex gap-2">


                @if(($page ?? 1) > 1)

                    <a href="{{ request()->fullUrlWithQuery(['page' => ($page ?? 1) - 1]) }}"
                        class="rounded-md border px-4 py-2 text-sm hover:bg-slate-50">
                        Sebelumnya
                    </a>

                @endif



                @if(($page ?? 1) < ($lastPage ?? 1))

                    <a href="{{ request()->fullUrlWithQuery(['page' => ($page ?? 1) + 1]) }}"
                        class="rounded-md border px-4 py-2 text-sm hover:bg-slate-50">
                        Berikutnya
                    </a>

                @endif


            </div>


        </div>


    </section>



@endsection