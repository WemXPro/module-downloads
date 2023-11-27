@extends(AdminTheme::wrapper(), ['title' => __('Downloads'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('container')
    <section class="section">
        <div class="section-body">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Downloads') }}</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody>
                                    <tr>
                                        <th>{!! __('Download Name') !!}</th>
                                        <th>{!! __('Description') !!}</th>
                                        <th>{!! __('Required Package') !!}</th>
                                        <th>{!! __('Allow Guest') !!}</th>
                                        <th>{!! __('Actions') !!}</th>
                                    </tr>

                                    @foreach ($downloads as $download)
                                        <tr>
                                            <td>{{ $download->name }}</td>
                                            <td>{{ $download->description }}</td>
                                            <td>{{ implode(', ', $download->package) }}</td>
                                            <td>
                                                <span class="{{ $download->allow_guest ? 'text-success' : 'text-danger' }}">
                                                    {{ $download->allow_guest ? 'Yes' : 'No' }}
                                                </span>
                                            </td>

                                            <td>
                                                <a href="{{ route('downloads.download', $download->id) }}"
                                                    class="btn btn-primary mr-2" title="{!! __('Download') !!}">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                <a href="{{ route('downloads.edit', $download->id) }}"
                                                    class="btn btn-warning mr-2" title="{!! __('Edit') !!}">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('downloads.destroy', $download->id) }}"
                                                    method="post" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        title="{!! __('Delete') !!}"
                                                        onclick="return confirm('Are you sure you want to delete this download?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        {{ $downloads->links(AdminTheme::pagination()) }}
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
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
@endsection
