<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'Santosa Hospital')
    </title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-slate-50 text-slate-800">


    <div class="flex min-h-screen">


        <!-- Sidebar -->
        <aside class="hidden w-64 flex-col border-r border-slate-200 bg-white md:flex">

            <div class="border-b border-slate-200 px-6 py-5">

                <h1 class="text-lg font-bold text-blue-700">
                    Santosa Hospital
                </h1>

                <p class="mt-1 text-xs text-slate-500">
                    Information System
                </p>

            </div>



            <nav class="flex-1 px-4 py-5 space-y-2">


                <a href="{{ route('dashboard') }}"
                    class="block rounded-md px-4 py-2.5 text-sm hover:bg-blue-50 hover:text-blue-700">

                    Dashboard

                </a>



                <a href="{{ route('patients') }}"
                    class="block rounded-md px-4 py-2.5 text-sm hover:bg-blue-50 hover:text-blue-700">

                    Data Pasien

                </a>



                <a href="{{ route('visits.index') }}"
                    class="block rounded-md px-4 py-2.5 text-sm hover:bg-blue-50 hover:text-blue-700">

                    Data Kunjungan

                </a>


            </nav>



            <div class="border-t border-slate-200 px-5 py-4">

                <p class="text-xs text-slate-500">
                    Sistem Informasi Rumah Sakit
                </p>

            </div>


        </aside>





        <!-- Main Area -->

        <div class="flex flex-1 flex-col">



            <!-- Top Navbar -->

            <header class="flex h-16 items-center justify-between border-b border-slate-200 bg-white px-6">


                <div>

                    <h2 class="font-semibold">
                        @yield('header', 'Santosa Hospital')
                    </h2>

                </div>



                <div class="text-right">

                    <p class="text-sm font-medium">
                        Administrator
                    </p>

                    <p class="text-xs text-slate-500">
                        IT System
                    </p>

                </div>


            </header>





            <!-- Content -->

            <main class="flex-1 px-6 py-8">


                @yield('content')


            </main>





            <!-- Footer -->

            <footer class="border-t border-slate-200 bg-white px-6 py-4">


                <p class="text-center text-sm text-slate-500">

                    © {{ date('Y') }} Santosa Hospital.
                    Sistem Informasi Rumah Sakit

                </p>


            </footer>



        </div>


    </div>


</body>

</html>