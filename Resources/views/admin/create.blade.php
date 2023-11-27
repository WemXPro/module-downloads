@extends(AdminTheme::wrapper(), ['title' => __('Downloads'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('css_libraries')
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.css')) }}" />
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/select2/dist/css/select2.min.css')) }}">
@endsection

@section('js_libraries')
    <script src="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.js')) }}"></script>
    <script src="{{ asset(AdminTheme::assets('modules/select2/dist/js/select2.full.min.js')) }}"></script>
@endsection

@section('container')
    <section class="section">
        <div class="section-body">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Downloads</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('downloads.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                    <small class="form-text text-muted">Downloads name</small>
                                </div>

                                <div class="form-group col-6">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" name="description" required></textarea>
                                </div>

                                <div class="form-group col-6">
                                    <label for="package">Required Package:</label>
                                    <input type="text" class="form-control" name="package[]" placeholder="Package 1"
                                        required>
                                    <input type="text" class="form-control" name="package[]" placeholder="Package 2">
                                    <!-- Add more package inputs if needed -->
                                </div>

                                <div class="form-group col-6">
                                    <label for="allow_guest">Allow Guest:</label>
                                    <input class="form-control" type="checkbox" name="allow_guest">
                                </div>

                                <div class="form-group col-6">
                                    <label for="file">File (ZIP only):</label>
                                    <input class="form-control" type="file" name="file" accept=".zip" required>
                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
