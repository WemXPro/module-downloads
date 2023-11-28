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
        $downloads = Download::all();
        return view('downloads::client.downloads', compact('downloads'));
    }

    public function download($id)
    {
        $download = Download::findOrFail($id);
        $filePath = storage_path('app/public/downloads/' . $download->file_path);

        return response()->download($filePath, $download->name);
    }
}
