<?php

namespace App\Imports;

use App\Data;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class DataImport implements ToModel, WithStartRow, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($this->isEmptyRow($row)) {
            return null;
        }

        return new Data([
            'claim_date' => $this->date($row, 1),
            'month_rec' => $this->text($row, 2),
            'year_rec' => $this->text($row, 3),
            'claim_type' => $this->text($row, 4),
            'product' => $this->text($row, 5),
            'source_document' => $this->text($row, 6),
            'claim_reason' => $this->text($row, 7),
            'no_claim' => $this->text($row, 8),
            'no_certificate' => $this->text($row, 9),
            'status_policy' => $this->text($row, 10),
            'effective_date' => $this->date($row, 11),
            'expired_date' => $this->date($row, 12),
            'partner_distribution_chanel' => $this->text($row, 13),
            'branch' => $this->text($row, 14),
            'address' => $this->text($row, 15),
            'city' => $this->text($row, 16),
            'province' => $this->text($row, 17),
            'holder_name' => $this->text($row, 18),
            'insured_name' => $this->text($row, 19),
            'gender' => $this->text($row, 20),
            'age' => $this->text($row, 21),
            'red_flag' => $this->text($row, 22),
            'benefit_per_day' => $this->text($row, 23),
            'benefit_amount' => $this->text($row, 24),
            'claim_year' => $this->text($row, 25),
            'age_of_policy' => $this->text($row, 26),
            'event_date_from' => $this->date($row, 27),
            'event_date_to' => $this->date($row, 28),
            'date_of_death' => $this->date($row, 29),
            'length_of_stay' => $this->text($row, 30),
            'icu' => $this->text($row, 31),
            'remaining_days_per_year_diare_dan_typhoid' => $this->text($row, 32),
            'remaining_days_per_year' => $this->text($row, 33),
            'exgratia' => $this->text($row, 34),
            'dokumen_status' => $this->text($row, 35),
            'doc_receive_date' => $this->date($row, 36),
            'doc_complete_date' => $this->date($row, 37),
            'information_complete_date' => $this->date($row, 38),
            'prev_status' => $this->text($row, 39),
            'claim_status' => $this->text($row, 40),
            'reject_status' => $this->text($row, 41),
            'claim_amount' => $this->money($row, 42),
            'claim_amount_paid' => $this->money($row, 43),
            'claim_amount_not_paid' => $this->money($row, 44),
            'rop' => $this->text($row, 45),
            'nilai_tunai' => $this->text($row, 46),
            'hospital_name' => $this->text($row, 47),
            'doctor_name' => $this->text($row, 48),
            'doctor_specialization' => $this->text($row, 49),
            'diagnosis_1' => $this->text($row, 50),
            'diagnosis_description' => $this->text($row, 51),
            'diagnosis_2' => $this->text($row, 52),
            'surgery_name' => $this->text($row, 53),
            'age_pending' => $this->text($row, 54),
            'aging_pending' => $this->text($row, 55),
            'decision_date' => $this->date($row, 56),
            'month_dec' => $this->text($row, 57),
            'year_dec' => $this->text($row, 58),
            'modified_by' => $this->text($row, 59),
            'claimant_relation' => $this->text($row, 61),
        ]);
    }

    /**
     * @param array $row
     * @param int $index
     * @return mixed
     */
    private function cell(array $row, $index)
    {
        return $row[$index] ?? null;
    }

    /**
     * @param array $row
     * @param int $index
     * @return string|null
     */
    private function text(array $row, $index)
    {
        $value = $this->stringValue($this->cell($row, $index));

        return $value === null ? null : Str::limit($value, 255, '');
    }

    /**
     * @param array $row
     * @param int $index
     * @return string|null
     */
    private function date(array $row, $index)
    {
        $value = $this->cell($row, $index);

        if ($value instanceof \DateTimeInterface) {
            return $value->format('Y-m-d');
        }

        $value = $this->stringValue($value);

        if ($value === null) {
            return null;
        }

        if (is_numeric($value)) {
            $serial = (float) $value;

            if ($serial >= 1 && $serial <= 2958465) {
                try {
                    return ExcelDate::excelToDateTimeObject($serial)->format('Y-m-d');
                } catch (\Throwable $e) {
                    return null;
                }
            }

            if (preg_match('/^\d{8}$/', $value)) {
                try {
                    return Carbon::createFromFormat('Ymd', $value)->format('Y-m-d');
                } catch (\Throwable $e) {
                    return Str::limit($value, 255, '');
                }
            }

            return Str::limit($value, 255, '');
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Throwable $e) {
            return Str::limit($value, 255, '');
        }
    }

    /**
     * @param array $row
     * @param int $index
     * @return int|null
     */
    private function money(array $row, $index)
    {
        $value = $this->stringValue($this->cell($row, $index));

        if ($value === null) {
            return null;
        }

        if (is_numeric($value)) {
            return $this->clampInteger((float) $value);
        }

        $negative = false;

        if (preg_match('/^\(.*\)$/', $value)) {
            $negative = true;
            $value = trim($value, '()');
        }

        $clean = preg_replace('/[^0-9,.\-]/', '', $value);

        if ($clean === '' || $clean === '-' || $clean === '.' || $clean === ',') {
            return null;
        }

        $lastComma = strrpos($clean, ',');
        $lastDot = strrpos($clean, '.');

        if ($lastComma !== false && $lastDot !== false) {
            if ($lastComma > $lastDot) {
                $clean = str_replace('.', '', $clean);
                $clean = str_replace(',', '.', $clean);
            } else {
                $clean = str_replace(',', '', $clean);
            }
        } elseif ($lastComma !== false) {
            $clean = $this->normalizeSingleSeparator($clean, ',');
        } elseif ($lastDot !== false) {
            $clean = $this->normalizeSingleSeparator($clean, '.');
        }

        if (!is_numeric($clean)) {
            return null;
        }

        $number = (float) $clean;

        if ($negative) {
            $number = -$number;
        }

        return $this->clampInteger($number);
    }

    /**
     * @param string $value
     * @param string $separator
     * @return string
     */
    private function normalizeSingleSeparator($value, $separator)
    {
        $parts = explode($separator, $value);

        if (count($parts) > 2 || (count($parts) === 2 && strlen($parts[1]) === 3)) {
            return str_replace($separator, '', $value);
        }

        if ($separator === ',') {
            return str_replace(',', '.', $value);
        }

        return $value;
    }

    /**
     * @param mixed $value
     * @return string|null
     */
    private function stringValue($value)
    {
        if ($value === null) {
            return null;
        }

        if (is_object($value) && method_exists($value, '__toString')) {
            $value = (string) $value;
        }

        if (!is_scalar($value)) {
            return null;
        }

        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    /**
     * @param float $value
     * @return int|null
     */
    private function clampInteger($value)
    {
        if ($value > 9223372036854775807 || $value < -9223372036854775808) {
            return null;
        }

        return (int) round($value);
    }

    /**
     * @param array $row
     * @return bool
     */
    private function isEmptyRow(array $row)
    {
        foreach ($row as $value) {
            if ($this->stringValue($value) !== null) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 500;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 500;
    }
}
