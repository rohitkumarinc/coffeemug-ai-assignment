<x-app-layout>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <br>
                <div class="card">
                    <div class="card-header">All Publish Story List</div>
                    <div class="card-body">

                        {!! Form::open(['method' => 'GET', 'url' => 'stories', 'class' => 'col-md-4 float-end', 'role' => 'search']) !!}
                        <div class="input-icon" style="display: flex">
                            <input type="text" class="form-control" name="search" value="{{ request()->search }}" placeholder="Search...">
                            <button class=" input-icon-addon" type="submit" style="padding: 0px 8px;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="10" cy="10" r="7"></circle>
                                    <line x1="21" y1="21" x2="15" y2="15"></line>
                                </svg>
                            </button>
                        </div>
                        {!! Form::close() !!}
                        <div class="container mt-5">
                            @foreach ($stories as $item)
                            <a href="{{ route('story_view', [$item->user->username, $item->slug]) }}" class="text-dark text-decoration-none">
                                <div class="post-about mb-4">
                                    <h4>{{ $item->title }}</h4>
                                    <p>Publish Date: {{ date('d M Y - h:m A', strtotime($item->publish_date)) }}</p>
                                    <div>
                                        <img style="max-height: 200px" src="{{ $item->file_path('image') }}" alt="">
                                    </div>
                                    @php
                                        $value = strip_tags($item->content);
                                        $value = \Str::limit($value, 120, '...');
                                    @endphp
                                    <p>{{ $value }}</p>
                                </div>
                            </a>

                            @if ($item->is_edit)
                                <a href="{{ url('stories/' . $item->id . '/edit') }}" title="Edit"><button class="btn btn-primary btn-sm">Edit</button></a>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['stories', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('Delete', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Intake',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    )) !!}
                                {!! Form::close() !!}
                            @endif

                            <hr>
                            @endforeach
                        </div>
                        {!! $stories->appends(['search' => Request::get('search')])->render() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
