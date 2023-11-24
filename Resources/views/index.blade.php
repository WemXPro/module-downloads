 @extends(AdminTheme::wrapper(), ['title' => 'Downloads', 'keywords' => 'Downloads Module'])

 @section('container')
     <div class="container">
         <h2>Create New Download</h2>

         @if ($errors->any())
             <div class="alert alert-danger">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div>
         @endif

         <form action="{{ route('downloads.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="card">
                 <div class="card-header">
                     <h4>Create New Download</h4>
                 </div>
                 <div class="card-body">
                     <div class="row">
                         <div class="form-group col-6">
                             <label>Description:</label>
                             <textarea name="description" class="form-control" required></textarea>
                         </div>
                         <div class="form-group col-6">
                             <label>Package:</label>
                             <select name="package[]" class="form-control" multiple required>

                                 <option value="package1">Package 1</option>
                                 <option value="package2">Package 2</option>
                                
                             </select>
                         </div>
                         <div class="form-group col-6">
                             <label>Name:</label>
                             <input type="text" name="name" class="form-control" required>
                         </div>
                         <div class="form-group col-6">
                             <label>Allow Guest:</label>
                             <input type="checkbox" name="allow_guest" class="form-check-input">
                         </div>
                         <div class="form-group col-6">
                             <label>File:</label>
                             <input type="file" name="file" class="form-control-file" accept=".zip" required>
                         </div>
                     </div>
                 </div>
                 <div class="card-footer text-right">
                     <button type="submit" class="btn btn-primary">Create Download</button>
                 </div>
             </div>
         </form>
     </div>
 @endsection
