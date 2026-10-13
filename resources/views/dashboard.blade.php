@extends('layouts.app')


@section('title', 'Dashboard')

@section('header', 'Dashboard')


@section('content')


    <div class="mb-6">

        <h2 class="text-2xl font-semibold">
            Dashboard Rumah Sakit
        </h2>


        <p class="text-sm text-slate-500 mt-2">
            Ringkasan data pasien dan kunjungan.
        </p>


    </div>



    <section class="grid gap-4 md:grid-cols-4">


        @foreach([
                'total_patient' => 'Total Pasien',
                'total_visit' => 'Total Kunjungan',
                'completed_visit' => 'Kunjungan Selesai',
                'cancelled_visit' => 'Kunjungan Batal',
                'registered_visit' => 'Terdaftar',
                'in_progress_visit' => 'Sedang Berlangsung',
                'total_doctor' => 'Total Dokter'
            ] as $key => $label)


            <div class="rounded-xl bg-white border p-5">


                <p class="text-sm text-slate-500">
                    {{ $label }}
                </p>


                <p class="mt-3 text-3xl font-semibold">

                    {{ number_format($summary[$key] ?? 0) }}

                </p>


            </div>


        @endforeach


    </section>




    <div class="mt-8 grid md:grid-cols-2 gap-5">


        <a href="{{ route('patients') }}" class="rounded-xl bg-white border p-6 hover:shadow">


            <h3 class="font-semibold">
                Data Pasien
            </h3>


            <p class="mt-2 text-sm text-slate-500">

                Cari pasien, lihat detail, dan riwayat kunjungan.

            </p>


        </a>




        <a href="{{ route('visits.index') }}" class="rounded-xl bg-white border p-6 hover:shadow">


            <h3 class="font-semibold">
                Data Kunjungan
            </h3>


            <p class="mt-2 text-sm text-slate-500">

                Filter dan lihat daftar kunjungan pasien.

            </p>


        </a>



    </div>


@endsection