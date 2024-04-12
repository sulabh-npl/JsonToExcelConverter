<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\FileUploadRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JsonToExcelExport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;


class FormController extends Controller
{

    public function index()
    {
        return view('form');
    }

    public function convert(FileUploadRequest $request)
    {
        $file = $request->file('file');

        // Read the JSON data from the file
        $json = file_get_contents($file->path());

        // Convert the JSON data to an array
        $data = json_decode($json, true);

        // Store the field names in the top of the data array
        $fieldNames = array_keys($data[0]);

        // Add the field names to the beginning of the data array
        array_unshift($data, $fieldNames);

        // Set the file name for the downloaded file
        $fileName = 'converted_file.xlsx';

        // Create the Excel file
        Excel::store(new JsonToExcelExport($data), $fileName);

        // Download the Excel file and delete it after sending
        return Response::download(storage_path('app/'.$fileName), $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ])->deleteFileAfterSend(true);

    }
}
