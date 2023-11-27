@extends(AdminTheme::wrapper(), ['title' => __('Edit Download'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('container')
    <section class="section">
        <div class="section-body">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Edit Download') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('downloads.update', $download->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Add your form fields here -->
                            <div class="form-group">
                                <label for="name">{{ __('Download Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $download->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea name="description" id="description" class="form-control" rows="3" required>{{ $download->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="package">{{ __('Required Package') }}</label>
                                <input type="text" name="package" id="package" class="form-control"
                                    value="{{ implode(', ', $download->package) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="allow_guest">{{ __('Allow Guest') }}</label>
                                <select name="allow_guest" id="allow_guest" class="form-control" required>
                                    <option value="1" {{ $download->allow_guest ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ !$download->allow_guest ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="file">{{ __('File') }}</label>
                                <input type="file" name="file" id="file" class="form-control-file">
                            </div>

                            <!-- Add more fields as needed -->

                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css_libraries')
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.css')) }}" />
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/select2/dist/css/select2.min.css')) }}">
@endsection

@section('js_libraries')
    <script src="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.js')) }}"></script>
    <script src="{{ asset(AdminTheme::assets('modules/select2/dist/js/select2.full.min.js')) }}"></script>
@endsection
