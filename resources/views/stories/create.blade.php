<x-app-layout>
    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-4 mb-4">
                <div class="card">
                    <div class="card-header">Create New Story</div>
                    <div class="card-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => 'stories', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include('stories.form', ['formMode' => 'create'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
