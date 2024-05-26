<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;

class FirebaseController extends Controller
{

    // API JSON
    public function getData($dataType)
    {
        $client = new Client();
        $url = env('FIREBASE_API_URL', '') . '/.json';

        try {
            $response = $client->get($url);
            $newData = json_decode($response->getBody(), true);

            if ($dataType === 'data' && isset($newData['Data'])) {
                $newDataSet = $newData['Data'];
            } else {
                return response()->json(['error' => 'Data not found'], 500);
            }

            $extractedData = [
                'kelembaban' => $newDataSet['kelembaban'],
                'suhu' => $newDataSet['suhu']
            ];

            $fileName = $dataType . '.json';
            $storedData = Storage::exists($fileName) ? json_decode(Storage::get($fileName), true) : [];

            $maxId = count($storedData) > 0 ? max(array_keys($storedData)) : 0;

            $newId = $maxId + 1;

            $storedData[$newId] = $extractedData;

            Storage::put($fileName, json_encode($storedData));

            return response()->json($storedData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Firebase'], 500);
        }
    }

    // Dashboard
    public function showDashboard($dataType)
    {
        session(['dashboardType' => $dataType]);

        $client = new Client();
        $url = env('FIREBASE_API_URL', '') . '/.json';

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            if ($dataType === 'data' && isset($data['Data'])) {
                $maggot = $data['Data'];

                return view('dashboard.dashboard', compact('maggot'));
            } else {
                return response()->json(['error' => 'Data not found COK'], 500);
            }
            if ($dataType === 'data' && isset($data['Data'])) {
                $maggot = $data['Data'];
                return response()->json($maggot);
            } else {
                return response()->json(['error' => 'Data not found'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Firebase'], 500);
        }
    }

    // Tugas Akhir DB
    public function showMaggotDashboard()
    {
        session(['dashboardType' => 'data']);

        $client = new Client();
        $url = env('FIREBASE_API_URL', '') . '/Data.json';

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            if (isset($data['Data'])) {
                $maggot = $data['Data'];

                return view('dashboard.dashboard', compact('data'));
            } else {
                return response()->json(['error' => 'Data maggot not found'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Firebase'], 500);
        }
    }

    // Rumah Jamur DB
    // public function showRumahJamurDashboard()
    // {
    //     session(['dashboardType' => 'rumah-jamur']);

    //     $client = new Client();
    //     $url = env('FIREBASE_API_URL', '') . '/.json';

    //     try {
    //         $response = $client->get($url);
    //         $data = json_decode($response->getBody(), true);

    //         if (isset($data['RumahJamur'])) {
    //             $rumahJamurData = $data['RumahJamur'];

    //             return view('dashboard.dashboard', compact('rumahJamurData'));
    //         } else {
    //             return response()->json(['error' => 'RumahJamur data not found'], 500);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Failed to fetch data from Firebase'], 500);
    //     }
    // }

    // History
    public function showHistory($collection)
    {
        try {
            $fileName = $collection . 'Data.json';
            $filePath = storage_path('app/' . $fileName);

            if (!file_exists($filePath)) {
                return response()->json(['error' => 'File not found'], 500);
            }

            $jsonString = file_get_contents($filePath);
            $data = json_decode($jsonString, true);

            $avghData = [];
            $avgtData = [];

            // Get the 100 latest data points
            $data = array_slice($data, -100, 100, true);

            foreach ($data as $key => $value) {
                if (isset($value['kelembaban']) && isset($value['suhu'])) {
                    $avghData[$key] = $value['kelembaban'];
                    $avgtData[$key] = $value['suhu'];
                }
            }

            return view('history.history', compact('avghData', 'avgtData'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from JSON file'], 500);
        }
    }
}
