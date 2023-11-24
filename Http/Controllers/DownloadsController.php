<?php

namespace Modules\Downloads\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Modules\Downloads;
use Illuminate\Support\Facades\Storage;
class DownloadsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $downloads = Download::all();

        return view('downloads::index', compact('downloads'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('downloads::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $request->validate([
            'description' => 'required',
            'package' => 'required|array',
            'name' => 'required',
            'allow_guest' => 'boolean',
            'file' => 'required|file|mimes:zip|max:2048',
        ]);


        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('downloads', $fileName, 'public');


        Download::create([
            'description' => $request->input('description'),
            'package' => $request->input('package'),
            'name' => $request->input('name'),
            'allow_guest' => $request->input('allow_guest', false),
            'file_path' => $fileName,
        ]);

        return redirect()->route('downloads.index')->with('success', 'Download created successfully.');
    }

    public function download($id)
    {
        $download = Download::findOrFail($id);

        $filePath = storage_path('app/public/downloads/' . $download->file_path);

        return response()->download($filePath, $download->name);
    }


}
