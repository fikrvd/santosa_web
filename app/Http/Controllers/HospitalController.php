<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HospitalController extends Controller
{
    public function dashboard(Request $request)
    {
        $response = Http::acceptJson()->get(
            env('SANTOSA_API_URL') . '/dashboard/summary',
            $request->only('date_from', 'date_to')
        );

        if (!$response->successful()) {
            return response('API Dashboard gagal: ' . $response->status(), 502);
        }

        $summary = $response->json('data', []);

        return view('dashboard', compact('summary'));
    }

    public function patients(Request $request)
    {
        $params = $request->only(
            'search',
            'gender',
            'blood_type',
            'page',
            'per_page'
        );

        $params['page'] = $params['page'] ?? 1;
        $params['per_page'] = $params['per_page'] ?? 15;

        $response = Http::acceptJson()->get(
            env('SANTOSA_API_URL') . '/patients',
            $params
        );

        if (!$response->successful()) {
            return response('API Pasien gagal: ' . $response->status(), 502);
        }

        $patients = $response->json('data', []);

        $filters = $request->only('search', 'gender', 'blood_type');

        return view('patients', compact('patients', 'filters'));
    }


    public function showPatient($medical_record_no)
    {
        $response = Http::acceptJson()->get(
            env('SANTOSA_API_URL') . '/patients/' . rawurlencode($medical_record_no)
        );

        if (!$response->successful()) {
            return response('Gagal mengambil detail pasien: ' . $response->status(), 502);
        }

        $patient = $response->json('data', []);

        return view('patient-detail', compact('patient'));
    }

    public function visitHistory(Request $request, $medical_record_no)
    {
        $params = $request->only('page', 'per_page');
        $params['page'] = $params['page'] ?? 1;
        $params['per_page'] = $params['per_page'] ?? 10;

        $response = Http::acceptJson()->get(
            env('SANTOSA_API_URL') . '/patients/' .
            rawurlencode($medical_record_no) . '/visit-history',
            $params
        );

        if (!$response->successful()) {
            return response(
                'Gagal mengambil riwayat: ' . $response->status(),
                502
            );
        }

        $result = $response->json();
        $data = $result['data'] ?? [];
        $meta = $data['meta'] ?? $result['meta'] ?? [];

        $page = (int) ($meta['current_page'] ?? $request->input('page', 1));
        $lastPage = (int) ($meta['last_page'] ?? 1);

        return view('visit-history', [
            'patient' => $data['patient'] ?? [],
            'summary' => $data['summary'] ?? [],
            'visits' => $data['visits'] ?? [],
            'medical_record_no' => $medical_record_no,
            'page' => $page,
            'lastPage' => $lastPage,
        ]);
    }

    public function visits(Request $request)
    {
        $params = $request->only(
            'date_from',
            'date_to',
            'status',
            'visit_type',
            'page',
            'per_page'
        );

        $params['page'] = $params['page'] ?? 1;
        $params['per_page'] = $params['per_page'] ?? 15;

        $response = Http::acceptJson()->get(
            env('SANTOSA_API_URL') . '/visits',
            $params
        );

        if (!$response->successful()) {
            return response(
                'Gagal mengambil daftar kunjungan: ' . $response->status(),
                502
            );
        }

        $result = $response->json();

        return view('visits', [
            'visits' => $result['data'] ?? [],

            'filters' => $request->only(
                'date_from',
                'date_to',
                'status',
                'visit_type'
            ),

            'meta' => $result['meta'] ?? [],
        ]);
    }


}
