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

        Excel::import(new DataImport, public_path('/file_data/' . $nama_file));

        // notifikasi dengan session
        Session::flash('success', 'Data Imported Successfully!');

        // alihkan halaman kembali
        return redirect('/data');
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
