<x-app-layout>
    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <div class="post-about mb-4">
                    <h4>{{ $story->title }}</h4>
                    <p>Publish Date: {{ date('d M Y - h:m A', strtotime($story->publish_date)) }}</p>
                    <div>
                        <img src="{{ $story->file_path('image') }}" alt="">
                    </div>
                   {!! $story->content !!}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
