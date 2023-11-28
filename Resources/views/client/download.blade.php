@extends(Theme::wrapper(), ['title' => __('Downloads'), 'keywords' => 'WemX Dashboard, WemX Panel'])
@section('title', __('client.download'))
@section('keywords', 'WemX Dashboard, WemX Panel')

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="grid gap-8 px-4 mx-auto max-w-screen-lg lg:gap-16 lg:px-6">
            <div>
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Downloads</h2>
                <p class="font-light text-gray-500 dark:text-gray-400 sm:text-xl">Explore and download the latest modules for
                    an enhanced experience.</p>
            </div>
        </div><br>

        @if (isset($downloads))
            @foreach ($downloads as $download)
                <div
                    class="mt-1 mb-6 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col relative">
                    <div class="absolute top-0 right-0 mt-2 mr-6 text-gray-500 text-sm">
                        <i class="bx bx-time"></i>
                        <span class="ml-1">{{ $download->created_at->diffForHumans() }}</span>
                    </div>

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $download->name }}
                    </h5>

                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $download->description }}</p>

                    @if ($download->allow_guest == '0')
                        <div class="mt-auto text-right">
                            <span
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-500 bg-gray-200 rounded-lg cursor-not-allowed"
                                style="pointer-events: none;">
                                <i class='bx bxs-download'></i>&nbsp;Download
                            </span>
                            <p class="text-gray-500 text-sm mt-2">Note: You don't have permission to download.</p>
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
    </section>


@endsection
