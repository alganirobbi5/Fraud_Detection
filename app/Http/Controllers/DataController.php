<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Data;

use Session;
use File;
use Throwable;
use App\Imports\DataImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    /**
     * Jumlah kolom minimal yang dibutuhkan oleh DataImport.
     */
    private const MIN_IMPORT_COLUMNS = 62;

    public function index()
    {
        $data = Data::all();
        return view('tables.data', ['data' => $data]);
    }

    public function import_data(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'max:20480',
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());

                    if (!in_array($extension, ['csv', 'xls', 'xlsx'], true)) {
                        $fail('Format file harus .xlsx, .xls, atau .csv.');
                    }
                },
            ],
        ], [
            'file.required' => 'Pilih file Excel yang akan diimport.',
            'file.file' => 'File gagal diunggah, silakan coba lagi.',
            'file.max' => 'Ukuran file maksimal 20 MB.',
        ]);

        $file = $request->file('file');
        $storedPath = null;

        try {
            $this->validateSpreadsheet($file->getRealPath());

            $namaFile = $this->makeFileName($file->getClientOriginalName());
            $file->move(public_path('file_data'), $namaFile);
            $storedPath = public_path('file_data/' . $namaFile);

            $before = Data::count();
            Excel::import(new DataImport, $storedPath);
            $imported = Data::count() - $before;

            if ($imported === 0) {
                throw new \RuntimeException('Tidak ada baris data yang berhasil diimport. Pastikan file berisi data klaim dan tidak kosong.');
            }

            Session::flash('success', 'Berhasil import ' . number_format($imported, 0, ',', '.') . ' baris data klaim.');
        } catch (Throwable $e) {
            if ($storedPath !== null && File::exists($storedPath)) {
                File::delete($storedPath);
            }

            Log::error('Import data klaim gagal', [
                'file' => $file->getClientOriginalName(),
                'message' => $e->getMessage(),
            ]);

            return redirect('/data')->withErrors([
                'file' => $this->friendlyImportError($e),
            ]);
        }

        return redirect('/data');
    }

    /**
     * Pastikan file benar-benar berisi data klaim sebelum diproses.
     *
     * @param string $path
     * @return void
     *
     * @throws \RuntimeException
     */
    private function validateSpreadsheet($path)
    {
        $reader = IOFactory::createReaderForFile($path);
        $info = $reader->listWorksheetInfo($path);
        $sheet = $info[0] ?? [];

        $columns = (int) ($sheet['totalColumns'] ?? 0);
        $rows = (int) ($sheet['totalRows'] ?? 0);

        if ($columns < self::MIN_IMPORT_COLUMNS) {
            throw new \RuntimeException(
                'File tidak sesuai format data klaim. Dibutuhkan minimal ' . self::MIN_IMPORT_COLUMNS
                . ' kolom, tetapi file ini hanya memiliki ' . $columns . ' kolom.'
            );
        }

        if ($rows < 2) {
            throw new \RuntimeException(
                'File tidak memiliki baris data. Baris pertama harus berisi header dan baris kedua dan seterusnya berisi data klaim.'
            );
        }
    }

    /**
     * Ubah exception teknis menjadi pesan yang mudah dipahami pengguna.
     *
     * @param \Throwable $e
     * @return string
     */
    private function friendlyImportError(Throwable $e)
    {
        $message = $e->getMessage();

        if ($e instanceof \RuntimeException) {
            return $message;
        }

        if (stripos($message, 'could not be opened') !== false || stripos($message, 'not recognized') !== false) {
            return 'File tidak dapat dibaca. Pastikan file Excel tidak rusak dan tidak sedang dibuka di aplikasi lain.';
        }

        if (stripos($message, 'data too long') !== false) {
            return 'Ada data yang melebihi batas panjang kolom. Periksa kembali isi file Excel.';
        }

        if (stripos($message, 'incorrect integer value') !== false || stripos($message, 'out of range') !== false) {
            return 'Ada nilai angka yang tidak valid pada kolom nominal klaim. Periksa kembali format angka di file Excel.';
        }

        return 'Import gagal diproses. Pastikan format file sesuai template data klaim.';
    }

    /**
     * @param string $originalName
     * @return string
     */
    private function makeFileName($originalName)
    {
        $name = preg_replace('/[^A-Za-z0-9._-]/', '_', (string) $originalName);
        $name = trim($name, '._-');

        return uniqid('', true) . '_' . ($name === '' ? 'data.xlsx' : $name);
    }

    public function delete_data()
    {
        $file_path = public_path('file_data');
        if (File::isDirectory($file_path)) {
            File::cleanDirectory($file_path);
        }

        Data::query()->delete();

        // Flash a success message to the session
        Session::flash('success', 'Data and its files have been deleted successfully!');

        // Redirect back to the data page
        return redirect('/data');
    }



}
