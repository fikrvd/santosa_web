@extends('layouts.app')

@section('title', 'Daftar Pasien')

@section('header', 'Daftar Pasien')


@section('content')


    <div class="mb-6">

        <h2 class="text-2xl font-semibold tracking-tight">
            Data Pasien
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Cari pasien berdasarkan nama, nomor rekam medis, jenis kelamin, atau golongan darah.
        </p>

    </div>



    @if(session('error'))

        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

            {{ session('error') }}

        </div>

    @endif




    <!-- Filter -->

    <section class="rounded-xl border border-slate-200 bg-white p-6">


        <h3 class="mb-5 font-semibold">
            Filter Pasien
        </h3>


        <form method="GET" class="flex flex-wrap items-end gap-4">


            <div class="flex-1 min-w-[250px]">

                <label class="mb-2 block text-sm font-medium">
                    Nama / No. RM
                </label>


                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Cari pasien..."
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-600 focus:outline-none">


            </div>





            <div class="w-full sm:w-44">

                <label class="mb-2 block text-sm font-medium">
                    Jenis Kelamin
                </label>


                <select name="gender" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm">


                    <option value="">
                        Semua
                    </option>


                    <option value="M" @selected(($filters['gender'] ?? '') == 'M')>
                        Laki-laki
                    </option>


                    <option value="F" @selected(($filters['gender'] ?? '') == 'F')>
                        Perempuan
                    </option>


                </select>

            </div>





            <div class="w-full sm:w-44">

                <label class="mb-2 block text-sm font-medium">
                    Golongan Darah
                </label>


                <select name="blood_type" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm">


                    <option value="">
                        Semua
                    </option>


                    @foreach(['A', 'B', 'AB', 'O'] as $blood)

                        <option value="{{ $blood }}" @selected(($filters['blood_type'] ?? '') == $blood)>

                            {{ $blood }}

                        </option>

                    @endforeach


                </select>

            </div>




            <input type="hidden" name="per_page" value="15">



            <button class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800">

                Cari

            </button>



            <a href="{{ route('patients') }}" class="px-3 py-2.5 text-sm text-slate-600 hover:text-blue-700">

                Reset

            </a>


        </form>


    </section>







    <!-- Table -->

    <section class="mt-6 overflow-hidden rounded-xl border border-slate-200 bg-white">


        <div class="flex items-center justify-between border-b px-6 py-4">


            <h3 class="font-semibold">
                Data Pasien
            </h3>


            <span class="text-sm text-slate-500">

                {{ count($patients) }} data

            </span>


        </div>




        <div class="overflow-x-auto">


            <table class="w-full text-sm">


                <thead class="bg-slate-100">


                    <tr>


                        <th class="px-6 py-3 text-left font-medium">
                            No. RM
                        </th>


                        <th class="px-6 py-3 text-left font-medium">
                            Nama
                        </th>


                        <th class="px-6 py-3 text-left font-medium">
                            Gender
                        </th>


                        <th class="px-6 py-3 text-left font-medium">
                            Tanggal Lahir
                        </th>


                        <th class="px-6 py-3 text-left font-medium">
                            Golongan Darah
                        </th>


                        <th class="px-6 py-3 text-right font-medium">
                            Aksi
                        </th>


                    </tr>


                </thead>



                <tbody class="divide-y">


                    @forelse($patients as $patient)


                                <tr class="hover:bg-slate-50">


                                    <td class="px-6 py-4">

                                        {{ $patient['medical_record_no'] ?? '-' }}

                                    </td>



                                    <td class="px-6 py-4 font-medium">

                                        {{ $patient['name'] ?? '-' }}

                                    </td>




                                    <td class="px-6 py-4">

                                        @if(($patient['gender'] ?? '') == 'M')

                                            Laki-laki

                                        @elseif(($patient['gender'] ?? '') == 'F')

                                            Perempuan

                                        @else

                                            -

                                        @endif

                                    </td>




                                    <td class="px-6 py-4">

                                        {{ !empty($patient['date_of_birth'])
                        ? substr($patient['date_of_birth'], 0, 10)
                        : '-' }}

                                    </td>




                                    <td class="px-6 py-4">

                                        {{ $patient['blood_type'] ?? '-' }}

                                    </td>




                                    <td class="px-6 py-4 text-right">


                                        @if(!empty($patient['medical_record_no']))


                                            <a href="{{ route('patients.show', $patient['medical_record_no']) }}"
                                                class="font-medium text-blue-700 hover:underline">

                                                Detail

                                            </a>


                                        @else

                                            -

                                        @endif


                                    </td>


                                </tr>



                    @empty


                        <tr>

                            <td colspan="6" class="px-6 py-10 text-center text-slate-500">

                                Data pasien tidak ditemukan.

                            </td>

                        </tr>


                    @endforelse



                </tbody>


            </table>


        </div>





        <div class="flex justify-between border-t px-6 py-4">


            <span class="text-sm text-slate-500">

                Halaman {{ request('page', 1) }}

            </span>




            <div class="flex gap-2">


                @if((int) request('page', 1) > 1)

                    <a href="{{ request()->fullUrlWithQuery(['page' => (int) request('page', 1) - 1]) }}"
                        class="rounded-lg border px-3 py-2 text-sm hover:bg-slate-50">

                        Sebelumnya

                    </a>

                @endif




                @if(count($patients) >= (int) request('per_page', 15))

                    <a href="{{ request()->fullUrlWithQuery(['page' => (int) request('page', 1) + 1]) }}"
                        class="rounded-lg border px-3 py-2 text-sm hover:bg-slate-50">

                        Berikutnya

                    </a>

                @endif


            </div>


        </div>



    </section>



@endsection