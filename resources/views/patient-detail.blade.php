@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('header', 'Detail Pasien')


@section('content')


    <div class="mb-6">

        <a href="{{ route('patients') }}" class="text-sm text-blue-700 hover:underline">
            ← Kembali ke Daftar Pasien
        </a>


        <h2 class="mt-5 text-2xl font-semibold tracking-tight">
            Informasi Pasien
        </h2>


        <p class="mt-2 text-sm text-slate-500">
            Detail informasi pasien berdasarkan nomor rekam medis.
        </p>

    </div>





    <section class="overflow-hidden rounded-xl border border-slate-200 bg-white">


        <div class="border-b border-slate-200 px-6 py-5">

            <h3 class="font-semibold">
                Data Pasien
            </h3>

        </div>





        <div class="grid gap-6 px-6 py-6 md:grid-cols-2">



            <div>

                <p class="text-sm text-slate-500">
                    Nomor Rekam Medis
                </p>

                <p class="mt-1 font-medium">
                    {{ $patient['medical_record_no'] ?? '-' }}
                </p>

            </div>





            <div>

                <p class="text-sm text-slate-500">
                    Nama Pasien
                </p>

                <p class="mt-1 font-medium">
                    {{ $patient['name'] ?? '-' }}
                </p>

            </div>






            <div>

                <p class="text-sm text-slate-500">
                    Jenis Kelamin
                </p>


                <p class="mt-1 font-medium">

                    @if(($patient['gender'] ?? '') === 'M')

                        Laki-laki

                    @elseif(($patient['gender'] ?? '') === 'F')

                        Perempuan

                    @else

                        {{ $patient['gender'] ?? '-' }}

                    @endif

                </p>

            </div>







            <div>

                <p class="text-sm text-slate-500">
                    Tanggal Lahir
                </p>


                <p class="mt-1 font-medium">

                    {{ !empty($patient['date_of_birth'])
        ? substr($patient['date_of_birth'], 0, 10)
        : '-' }}

                </p>

            </div>







            <div>

                <p class="text-sm text-slate-500">
                    Telepon
                </p>


                <p class="mt-1 font-medium">
                    {{ $patient['phone'] ?? '-' }}
                </p>


            </div>







            <div>

                <p class="text-sm text-slate-500">
                    Golongan Darah
                </p>


                <p class="mt-1 font-medium">
                    {{ $patient['blood_type'] ?? '-' }}
                </p>


            </div>







            <div class="md:col-span-2">


                <p class="text-sm text-slate-500">
                    Alamat
                </p>


                <p class="mt-1 font-medium">

                    {{ $patient['address'] ?? '-' }}

                </p>


            </div>




        </div>







        <div class="border-t border-slate-200 px-6 py-5">


            <a href="{{ route('patients.history', $patient['medical_record_no'] ?? '') }}"
                class="inline-flex rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800">


                Lihat Riwayat Kunjungan


            </a>


        </div>




    </section>



@endsection