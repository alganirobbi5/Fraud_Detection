<?php

namespace App\Http\Controllers;

use App\Data;
use App\Scoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class ScoringController extends Controller
{
    public function index()
    {
        $data = Data::all();
        return view('tables.scoring', ['data' => $data]);
    }

    public function scoring()
    {
        $data = Data::all();

        if(Data::count() == 0){
            return redirect('/404');
        }

        $cityMostClaim = DB::table('data')
            ->select('city',DB::raw('COUNT(*) as most_city'))
            ->groupBy('city')
            ->orderByDesc('most_city')
            ->first();
        $mostCity = $cityMostClaim->city;
        $noCertificateCity = DB::table('data')
            ->where('city', $cityMostClaim->city)
            ->value('no_certificate');
        $provinceMostClaim = DB::table('data')
            ->where('no_certificate', $noCertificateCity)
            ->value('province');
        $addressMostClaim = DB::table('data')
            ->where('no_certificate', $noCertificateCity)
            ->value('address');
        $hospitalMostClaim = DB::table('data')
            ->where('no_certificate', $noCertificateCity)
            ->value('hospital_name');
        $claim_amountMostClaim = DB::table('data')
            ->where('no_certificate', $noCertificateCity)
            ->value('claim_amount');



        $highestClaimAmount = DB::table('data')
            ->select('city', 'no_certificate', DB::raw('MAX(claim_amount) as highest_claim'))
            ->groupBy('city', 'no_certificate')
            ->orderByDesc('highest_claim')
            ->first();
        $cityHighestClaim = $highestClaimAmount->city;
        $noCertificateClaim = $highestClaimAmount->no_certificate;
        $provinceHighestClaim = DB::table('data')
            ->where('no_certificate', $noCertificateClaim)
            ->value('province');
        $hospital_HighestClaim = DB::table('data')
            ->where('no_certificate', $noCertificateClaim)
            ->value('hospital_name');
        $highestDiagnosisClaim = DB::table('data')
            ->where('no_certificate', $noCertificateClaim)
            ->value('diagnosis_1');
        $highestDiagnosisDescClaim = DB::table('data')
            ->where('no_certificate', $noCertificateClaim)
            ->value('diagnosis_description');
        $highestDiagnosis_2claim = DB::table('data')
            ->where('no_certificate', $noCertificateClaim)
            ->value('diagnosis_2');
        $claim_amountHighestClaim = DB::table('data')
            ->where('no_certificate', $noCertificateClaim)
            ->value('claim_amount');



        $highestDiagnosis = DB::table('data')
            ->select('diagnosis_1', DB::raw('COUNT(*) as most_diagnosis'))
            ->groupBy('diagnosis_1')
            ->orderByDesc('most_diagnosis')
            ->first();
        $diagnosis = $highestDiagnosis->diagnosis_1;
        $noCertificateDiagnosis = DB::table('data')
            ->where('diagnosis_1', $diagnosis)
            ->value('no_certificate');
        $cityDiagnosis = DB::table('data')
            ->where('no_certificate', $noCertificateDiagnosis)
            ->value('city');
        $provinceDiagnosis = DB::table('data')
            ->where('no_certificate', $noCertificateDiagnosis)
            ->value('province');
        $hospital_HighestDiagnosis = DB::table('data')
            ->where('no_certificate', $noCertificateDiagnosis)
            ->value('hospital_name');
        $highestMostDiagnosis = DB::table('data')
            ->where('no_certificate', $noCertificateDiagnosis)
            ->value('diagnosis_1');
        $highestMostDiagnosisDesc = DB::table('data')
            ->where('no_certificate', $noCertificateDiagnosis)
            ->value('diagnosis_description');
        $highestMostDiagnosis_2 = DB::table('data')
            ->where('no_certificate', $noCertificateDiagnosis)
            ->value('diagnosis_2');
        $highestMostDiagnosisClaim = DB::table('data')
            ->where('no_certificate', $noCertificateDiagnosis)
            ->value('claim_amount');


        // Calculate the percentage of a given city from the city data table
        $cityDataCount = DB::table('data')
            ->where('city', $mostCity)
            ->count();
        $totalCities = DB::table('data')->count('city');
        $percentage = $cityDataCount / $totalCities * 100;

        // Calculate the percentage of a given claim_amount from the claim_amount data table
        $claim_amountCount = DB::table('data')
            ->where('claim_amount', $claim_amountMostClaim)
            ->count();
        $totalClaimAmount = DB::table('data')->count('claim_amount');
        $percentageClaimAmount = $claim_amountCount / $totalClaimAmount * 100;

        // Calculate the percentage of a given diagnosis_1 from the diagnosis_1 data table
        $diagnosisCount = DB::table('data')
            ->where('diagnosis_1', $highestMostDiagnosis)
            ->count();
        $totalDiagnosis = DB::table('data')->count('diagnosis_1');
        $percentageDiagnosis = $diagnosisCount / $totalDiagnosis * 100;





        $cityDataCount = DB::table('data')
            ->where('city', $mostCity)
            ->count();
        $totalCities = DB::table('data')->count('city');
        $percentage = $cityDataCount / $totalCities * 100;
        if ($percentage <= 30) {
            $score = 1;
        } elseif ($percentage >= 31 && $percentage <= 50) {
            $score = 2;
        } elseif ($percentage >= 51 && $percentage <= 70) {
            $score = 3;
        } elseif ($percentage >= 71 && $percentage <= 80) {
            $score = 4;
        } else {
            $score = 5;
        };


        $claim_amountCount = DB::table('data')
        ->where('claim_amount', $claim_amountMostClaim)
        ->count();
        $totalClaimAmount = DB::table('data')->count('claim_amount');
         $percentageClaimAmount = $claim_amountCount / $totalClaimAmount * 100;
        if ($percentageClaimAmount <= 30) {
            $scoreClaim = 1;
        } elseif ($percentageClaimAmount >= 31 && $percentageClaimAmount <= 50) {
            $scoreClaim = 2;
        } elseif ($percentageClaimAmount >= 51 && $percentageClaimAmount <= 70) {
            $scoreClaim = 3;
        } elseif ($percentageClaimAmount >= 71 && $percentageClaimAmount <= 80) {
            $scoreClaim = 4;
        } else {
            $scoreClaim = 5;
        };

        $diagnosisCount = DB::table('data')
            ->where('diagnosis_1', $highestMostDiagnosis)
            ->count();
        $totalDiagnosis = DB::table('data')->count('diagnosis_1');
        $percentageDiagnosis = $diagnosisCount / $totalDiagnosis * 100;
        if ($percentageDiagnosis <= 30) {
            $scoreDiagnosis = 1;
        } elseif ($percentageDiagnosis >= 31 && $percentageDiagnosis <= 50) {
            $scoreDiagnosis = 2;
        } elseif ($percentageDiagnosis >= 51 && $percentageDiagnosis <= 70) {
            $scoreDiagnosis = 3;
        } elseif ($percentageDiagnosis >= 71 && $percentageDiagnosis <= 80) {
            $scoreDiagnosis = 4;
        } else {
            $scoreDiagnosis = 5;
        };



        $diagnosis = $highestDiagnosis->diagnosis_1;
        $diagnosis_description = DB::table('data')
            ->where('diagnosis_1', $diagnosis)
            ->value('diagnosis_description');

        $diagnosis = $highestDiagnosis->diagnosis_1;
        $diagnosis_2 = DB::table('data')
            ->where('diagnosis_1', $diagnosis)
            ->value('diagnosis_2');

        $diagnosisHightestClaim = $highestDiagnosis->diagnosis_1;
        $diagnosis_description = DB::table('data')
            ->where('diagnosis_1', $diagnosisHightestClaim)
            ->value('diagnosis_description');

        $highestDiagnosisDescription = $highestDiagnosis->diagnosis_1;
        $diagnosis_description = DB::table('data')
            ->where('diagnosis_1', $highestDiagnosisDescription)
            ->value('diagnosis_description');

        $city = $cityMostClaim->most_city;
        $claim_amount = DB::table('data')
            ->where('city', $city)
            ->value('claim_amount');


        //grafik City With Most Claim
            $citiesForGraph = DB::table('data')
            ->select('city', DB::raw('COUNT(*) as claims_count'))
            ->distinct()
            ->groupBy('city')
            ->orderByDesc('claims_count')
            ->pluck('city');

            $total_city = DB::table('data')
            ->select('city', DB::raw('COUNT(*) as total_city'))
            ->distinct('no_certificate')
            ->groupBy('city')
            ->orderBy('total_city', 'desc')
            ->pluck('total_city');
        //grafik Highest Claim Amount
            $citiesForGraphClaimAmount = DB::table('data')
            ->select(DB::raw('MAX(city) as city'))
            ->groupBy(DB::raw('city'))
            ->pluck('city');

            $total_claimAmount = DB::table('data')
            ->select(DB::raw('MAX(claim_amount) as highest_claim'))
            ->groupBy(DB::raw('city'))
            ->pluck('highest_claim');

        //grafik Highest Diagnosis
            $DiagnosisForGraph = DB::table('data')
            ->select(DB::raw('MAX(diagnosis_description) as diagnosis'))
            ->groupBy(DB::raw('diagnosis_description'))
            ->pluck('diagnosis');

            $total_highestDiagnosis = DB::table('data')
            ->select(DB::raw('COUNT(diagnosis_description) as highest_diagnosis'))
            ->groupBy(DB::raw('diagnosis_description'))
            ->pluck('highest_diagnosis');
     
            






        return view(

            'tables.scoring',
            [
                'data' => $data,
                'citiesForGraph' => $citiesForGraph, 
                'total_city' => $total_city,
                'cityMostClaim' => $cityMostClaim,
                'mostCity' => $mostCity,
                'highestClaimAmount' => $highestClaimAmount,
                'highestDiagnosis' => $diagnosis,
                'percentage' => $percentage,
                'percentageClaimAmount' => $percentageClaimAmount,
                'percentageDiagnosis' => $percentageDiagnosis,
                'score' => $score,
                'scoreClaim' => $scoreClaim,
                'scoreDiagnosis' => $scoreDiagnosis,
                'noCertificateCity' => $noCertificateCity,
                'noCertificateClaim' => $noCertificateClaim,
                'noCertificateDiagnosis' => $noCertificateDiagnosis,
                'provinceMostClaim' => $provinceMostClaim,
                'addressMostClaim' => $addressMostClaim,
                'provinceHighestClaim' => $provinceHighestClaim,
                'provinceDiagnosis' => $provinceDiagnosis,
                'hospitalMostClaim' => $hospitalMostClaim,
                'hospital_HighestClaim' => $hospital_HighestClaim,
                'hospital_HighestDiagnosis' => $hospital_HighestDiagnosis,
                'cityHighestClaim' => $cityHighestClaim,
                'diagnosis_description' => $diagnosis_description,
                'diagnosis_2' => $diagnosis_2,
                'diagnosisHightestClaim' => $diagnosisHightestClaim,
                'highestDiagnosisClaim' => $highestDiagnosisClaim,
                'highestDiagnosis_2claim' => $highestDiagnosis_2claim,
                'highestDiagnosisDescClaim' => $highestDiagnosisDescClaim,
                'highestDiagnosisDescription' => $highestDiagnosisDescription,
                'highestMostDiagnosis' => $highestMostDiagnosis,
                'highestMostDiagnosisDesc' => $highestMostDiagnosisDesc,
                'highestMostDiagnosis_2' => $highestMostDiagnosis_2,
                'highestMostDiagnosisClaim' => $highestMostDiagnosisClaim,
                'claim_amount' => $claim_amount,
                'claim_amountHighestClaim' => $claim_amountHighestClaim,
                'claim_amountMostClaim' => $claim_amountMostClaim,
                'citiesForGraphClaimAmount' => $citiesForGraphClaimAmount,
                'total_claimAmount' => $total_claimAmount,
                'DiagnosisForGraph' => $DiagnosisForGraph,
                'total_highestDiagnosis' => $total_highestDiagnosis
            ]
        );
    }

    
}
