<?php
namespace Modules\Downloads\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Downloads\Entities\Download;
use Illuminate\Support\Facades\Storage;

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
}
