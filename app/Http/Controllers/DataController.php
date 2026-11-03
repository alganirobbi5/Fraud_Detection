<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Data;

use Session;
use File;
use Carbon\Carbon;
use App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function index()
    {
        $data = Data::all();
        return view('tables.data', ['data' => $data]);
    }

    public function import_data(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
            
        ]);
       
        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_data di dalam folder public
        $file->move('file_data', $nama_file);

        // import data
        $dateColumns = ['claim_date',
                        'effective_date',
                        'expired_date',
                        'event_date_from',
                        'event_date_to',
                        'date_of_death',
                        'doc_receive_date',
                        'doc_complete_date',
                        'information_complete_date',
                        'decision_date']; // specify the date columns that need to be formatted

        Excel::import(new DataImport, public_path('/file_data/' . $nama_file), null, \Maatwebsite\Excel\Excel::XLSX, [
            'beforeSheet' => function($event) use ($dateColumns) {
                $sheet = $event->getSheet()->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) { // start from row 2 assuming row 1 is the header
                    foreach ($dateColumns as $column) {
                        $cell = $sheet->getCell($column.$row);
                        $value = $cell->getValue();
                        if (\PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($cell)) {
                            $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
                            $cell->setValue($dateValue->format('Y-m-d'));
                        } elseif (is_numeric($value)) {
                            // Handle numeric date values that are not actually Excel dates
                            $cell->setValue(null); // or handle as needed
                        }
                    }
                }
            }
        ]);

        // notifikasi dengan session
        Session::flash('success', 'Data Imported Successfully!');

        // alihkan halaman kembali
        return redirect('/data');
    }

    public function delete_data()
    {
    // Retrieve all data
    $allData = Data::all();

    foreach ($allData as $data) {
        // Delete the associated file from the storage
        $file_path = public_path('/file_data/' . $data->nama_file);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }

        // Delete the data from the database
        $data->delete();
    }


    // Delete the data from the database
    $data->delete();

    // Flash a success message to the session
    Session::flash('success', 'Data and its files have been deleted successfully!');

    // Redirect back to the data page
    return redirect('/data');
    }



}
