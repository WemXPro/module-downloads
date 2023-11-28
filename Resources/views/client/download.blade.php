@extends(Theme::wrapper(), ['title' => __('Downloads'), 'keywords' => 'WemX Dashboard, WemX Panel'])
@section('title', __('client.download'))
@section('keywords', 'WemX Dashboard, WemX Panel')

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="">
            <div>
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Downloads</h2>
                <p class="font-light text-gray-500 dark:text-gray-400 sm:text-xl">Explore and download the latest modules for
                    an enhanced experience.</p>
            </div>
        </div><br>

        @if (isset($downloads))
            @foreach ($downloads as $download)
                <div class="mt-1 mb-6 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-800 flex flex-col relative">

                    <div class="flex justify-between">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $download->name }}
                        </h5>
                        <div class="flex">
                            <span class="flex items-center text-sm text-gray-500 sm:text-center dark:text-gray-400 mr-3">
                                <i class='bx bxs-time mr-1'></i> {{ $download->created_at->diffForHumans() }}
                            </span>
                            <span class="flex items-center text-sm text-gray-500 sm:text-center dark:text-gray-400 mr-3">
                                <i class='bx bxs-file-archive mr-1'></i> 5.6 MB
                            </span>
                            <span class="flex items-center text-sm text-gray-500 sm:text-center dark:text-gray-400 mr-3">
                                <i class='bx bxs-cloud-download mr-1' ></i> 600 downloads
                            </span>
                        </div>
                    </div>

                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $download->description }}</p>

                    @if (!$download->allow_guest)
                        <div class="mt-auto text-right">
                            <span
                                class="inline-flex items-center cursor-not-allowed px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <i class='bx bxs-lock' ></i>&nbsp; No Access
                            </span>
                        </div>
                    @else
                        <div class="mt-auto text-right">
                            <a href="{{ route('downloads.client.download', ['id' => $download->id]) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <i class='bx bxs-download'></i>&nbsp;Download
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
        <div class="card-footer text-right">
            {{ $downloads->links(Theme::pagination()) }}
        </div>
    </section>


@endsection
