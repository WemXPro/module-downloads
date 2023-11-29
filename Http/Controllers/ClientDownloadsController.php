<?php
namespace Modules\Downloads\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Downloads\Entities\Download;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ClientDownloadsController extends Controller
{
    public function index()
    {
        $downloads = Download::paginate(15);    
        return view('downloads::client.download', compact('downloads'));
    }

    public function download($id)
    {
        $download = Download::findOrFail($id);
        $filePath = storage_path('app/public/Database/Downloadfile/' . $download->file_path);

        return response()->download($filePath, $download->name);
    }

    public static function humanFilesize($bytes, $decimals = 2)
    {
        $size = ['B','kB','MB','GB','TB','PB','EB','ZB','YB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
}
