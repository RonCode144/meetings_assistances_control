<?php

namespace App\Http\Controllers;

use App\Models\ReuAsistentes;
use Illuminate\Http\Request;

class SignaturePadController extends Controller
{
    public function index()
    {
        return view('signaturePad');
    }

    public function store(Request $request, ReuAsistentes $reuasistentes)
    {

        // if($request->hasFile('firma')){
        //     $file = $request->file('firma');
        //     $extention = $file->getClientOriginalExtension();
        //     $filename = time().'.'.$extention;
        //     $file->move('uploads');
        //     $reuasistentes->firma = $filename;
        // }
    }

    public function upload(Request $request)
    {
        // $folderPath = public_path('uploads/');
        // $image_parts = explode(";base64,", $request->signed);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        // $image_base64 = base64_decode($image_parts[1]);

        // $file = $folderPath . uniqid() . '.'.$image_type;
        // file_put_contents($file, $image_base64);

        return back()->with('success', '¡Firma registrada exitosamente!');
    }
}
