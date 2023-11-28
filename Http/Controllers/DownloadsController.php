<?php
namespace Modules\Downloads\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Downloads\Entities\Download;
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
            'package' => 'required',
            'name' => 'required',
            'allow_guest' => '',
            'file' => 'required|file|mimes:zip',
        ]);
    
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalExtension();
        
        // Get the base path of the module
        $modulePath = base_path('Modules/Downloads/');
        
        // Define the custom path within the module
        $customPath = 'Database/Downloadfile';
        
        // Store the file in the custom path
        $file->storeAs($customPath, $fileName, 'public');
    
        // Determine if allow_guest is checked
        
    
        // Use the storeAs method with the desired path
        $file->storeAs($customPath, $fileName, 'public');
    
        $packages = implode(',', $request->input('package'));
        
       
        $download = new Download;
        $download->description = $request->description;
        $download->package = $packages;
        $download->name = $request->name;
        $download->allow_guest = $request->allow_guest;
        $download->file_path = $fileName;
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
            'package' => 'required',
            'name' => 'required',
            'allow_guest' => '', // Make sure 'allow_guest' is treated as a boolean
            'file' => 'file|mimes:zip|max:2048',
        ]);
    
        if ($request->hasFile('file')) {
            $this->updateFile($request, $download);
        }
    
       
        // Use boolean() method to cast 'allow_guest' to boolean
        $packages = implode(',', $request->input('package'));
    
        $download->description = $request->description;
        $download->package = $packages;
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
