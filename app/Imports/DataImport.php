<?php

namespace App\Imports;

use App\Data;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DataImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Data([
            'claim_date' => $row[1],
            'month_rec' => $row[2],
            'year_rec' => $row[3],
            'claim_type' => $row[4],
            'product' => $row[5],
            'source_document' => $row[6],
            'claim_reason' => $row[7],
            'no_claim' => $row[8],
            'no_certificate' => $row[9],
            'status_policy' => $row[10],
            'effective_date' => $row[11],
            'expired_date' => $row[12],
            'partner_distribution_chanel' => $row[13],
            'branch' => $row[14],
            'address' => $row[15],
            'city' => $row[16],
            'province' => $row[17],
            'holder_name' => $row[18],
            'insured_name' => $row[19],
            'gender' => $row[20],
            'age' => $row[21],
            'red_flag' => $row[22],
            'benefit_per_day' => $row[23],
            'benefit_amount' => $row[24],
            'claim_year' => $row[25],
            'age_of_policy' => $row[26],
            'event_date_from' => $row[27],
            'event_date_to' => $row[28],
            'date_of_death' => $row[29],
            'length_of_stay' => $row[30],
            'icu' => $row[31],
            'remaining_days_per_year_diare_dan_typhoid' => $row[32],
            'remaining_days_per_year' => $row[33],
            'exgratia' => $row[34],
            'dokumen_status' => $row[35],
            'doc_receive_date' => $row[36],
            'doc_complete_date' => $row[37],
            'information_complete_date' => $row[38],
            'prev_status' => $row[39],
            'claim_status' => $row[40],
            'reject_status' => $row[41],
            'claim_amount' => $row[42],
            'claim_amount_paid' => $row[43],
            'claim_amount_not_paid' => $row[44],
            'rop' => $row[45],
            'nilai_tunai' => $row[46],
            'hospital_name' => $row[47],
            'doctor_name' => $row[48],
            'doctor_specialization' => $row[49],
            'diagnosis_1' => $row[50],
            'diagnosis_description' => $row[51],
            'diagnosis_2' => $row[52],
            'surgery_name' => $row[53],
            'age_pending' => $row[54],
            'aging_pending' => $row[55],
            'decision_date' => $row[56],
            'month_dec' => $row[57],
            'year_dec' => $row[58],
            'modified_by' => $row[59],
            'claimant_relation' => $row[61],


        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
   
}
