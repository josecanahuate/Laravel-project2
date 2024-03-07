<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UploadManager extends Controller
{
    function upload(){
        if (!Auth::check()){
            return redirect(route('login')); //si el usuario no está logeado, redirige al login
        }
        return view('upload');
    }

    
    function uploadPost(Request $request ){
        $file = $request->file("file"); //guardamos el archivo en una variable
        echo 'File Name: ' . $file->getClientOriginalName();//mostramos el nombre del archivo
        echo '<br>';
        echo 'File Extension: '. $file->getClientOriginalextension(); //mostramos la extension del archivo
        echo '<br>';
        echo 'File Real Path: '. $file->getRealPath(); //mostramos  la ruta real del archivo
        echo '<br>';
        echo 'File Size: '. $file->getSize();//mostramos el tamaño del archivo
        echo '<br>';
        echo 'File Mime Type: '.$file->getMimeType(); //mostramos la extension del archivo
        
        $destinationPath = "uploads"; //todos los archivos subidos se almacenaran en la carpeta creada en public/upload
        //el nombre de la carpeta no puede ser igual al nombre de la ruta en web.php porque ambos estan en public y dara error
/*         if ($file->move($destinationPath, $file->getClientOriginalName())) {
            echo "File Upload Success"; 
            return redirect(route('home'));
        } else {
            echo "There was an error uploading the file!";
        } */

        if ($file->move($destinationPath, $file->getClientOriginalName())) {
            // Archivo cargado exitosamente
            session()->flash('success', 'File upload successful. Try Another');
            return redirect(route('upload'));
        } else {
            // Error al cargar el archivo
            session()->flash('error', 'There was an error uploading the file!');
            return redirect()->back();
        }
        
    }


}
