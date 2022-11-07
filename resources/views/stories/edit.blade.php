<x-app-layout>
    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-4 mb-4">
                <div class="card">
                    <div class="card-header">Edit story #{{ $story->id }}</div>
                    <div class="card-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($story, [
                            'method' => 'PATCH',
                            'url' => ['/stories', $story->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include('stories.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
