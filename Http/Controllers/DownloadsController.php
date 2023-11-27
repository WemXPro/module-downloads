<?php
namespace Modules\Downloads\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Download;
use Illuminate\Support\Facades\Storage;

class DownloadsController extends Controller
{
    public function index()
    {
        $downloads = Download::paginate(10);
        return view('downloads::admin.index', compact('downloads'));
    }

    public function create()
    {
        return view('downloads::admin.create');
    }

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

        $download = Download::create([
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

    public function edit($id)
    {
        $download = Download::findOrFail($id);
        return view('downloads::admin.edit', compact('download'));
    }

    public function update(Request $request, $id)
    {
        $download = Download::findOrFail($id);

        $request->validate([
            'description' => 'required',
            'package' => 'required|array',
            'name' => 'required',
            'allow_guest' => 'boolean',
            'file' => 'file|mimes:zip|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $this->updateFile($request, $download);
        }

        $download->update([
            'description' => $request->input('description'),
            'package' => $request->input('package'),
            'name' => $request->input('name'),
            'allow_guest' => $request->input('allow_guest', false),
        ]);

        return redirect()->route('downloads.index')->with('success', 'Download updated successfully.');
    }

    public function destroy($id)
    {
        $download = Download::findOrFail($id);
        Storage::delete('downloads/' . $download->file_path);
        $download->delete();

        return redirect()->route('downloads.index')->with('success', 'Download deleted successfully.');
    }

    private function updateFile(Request $request, Download $download)
    {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('downloads', $fileName, 'public');
        Storage::delete('downloads/' . $download->file_path);
        $download->update(['file_path' => $fileName]);
    }
}
