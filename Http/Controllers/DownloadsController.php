<?php
namespace Modules\Downloads\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Downloads\Entities\Download;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

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
            'package' => 'nullable',
            'name' => 'required',
            'allow_guest' => 'boolean',
            'file' => 'required|file|mimes:zip',
        ]);
    
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalExtension();
        $modulePath = base_path('Modules/Downloads/');
        $customPath = 'Database/Downloadfile';
        $file->storeAs($customPath, $fileName, 'public');

        $fileSize = $file->getSize();

        $download = new Download;
        $download->description = $request->description;
        $download->package = $request->input('package', []);
        $download->name = $request->name;
        $download->allow_guest = $request->input('allow_guest');
        $download->file_path = $fileName;
        $download->file_size = $fileSize;
        $download->save();

    
        return redirect()->route('downloads.index')->with('success', 'Download created successfully.');
    }
    
    
    

    public function download($id)
    {
        $download = Download::findOrFail($id);
        $filePath = storage_path('app/public/Database/Downloadfile/' . $download->file_path);

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
            'package' => 'nullable',
            'name' => 'required',
            'allow_guest' => 'boolean', // Make sure 'allow_guest' is treated as a boolean
            'file' => 'file|mimes:zip|max:2048',
        ]);
    
        if ($request->hasFile('file')) {
            $this->updateFile($request, $download);
        }
    
        $download->description = $request->description;
        $download->package = $request->input('package', []);
        $download->name = $request->name;
        $download->allow_guest = $request->allow_guest;
    
        $download->save();
    
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
        
        $modulePath = base_path('Modules/Downloads/');
        
        $customPath = 'Database/Downloadfile';
        
        $file->storeAs($customPath, $fileName, 'public');
    
        Storage::disk('public')->delete($customPath . '/' . $download->file_path);
    
        $download->file_path = $fileName;
    }
}
