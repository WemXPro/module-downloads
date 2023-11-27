@extends(Theme::wrapper())
@section('title', __('client.dashboard'))
@section('keywords', 'WemX Dashboard, WemX Panel')

@section('container')
    <section class="section">
        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Downloads') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($downloads as $download)
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $download->name }}</h5>
                                            <p class="card-text">{{ $download->description }}</p>
                                            <a href="{{ route('downloads.client.download', $download->id) }}"
                                                class="btn btn-primary">{{ __('Download') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
