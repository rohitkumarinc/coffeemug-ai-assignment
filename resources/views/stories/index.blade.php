<x-app-layout>
    <h2 class="h-2">My Story</h2>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">stories</div>
                    <div class="card-body">


                        {!! Form::open(['method' => 'GET', 'url' => 'stories', 'class' => 'col-md-4 float-end', 'role' => 'search']) !!}
                        <div class="input-icon">
                            <input type="text" class="form-control" name="search" value="{{ request()->search }}" placeholder="Search...">
                            <button class=" input-icon-addon" type="submit" style="pointer-events: all;background: bottom;border: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="10" cy="10" r="7"></circle>
                                    <line x1="21" y1="21" x2="15" y2="15"></line>
                                </svg>
                            </button>
                        </div>
                        {!! Form::close() !!}
                        <br />
                        <br />
                        <div class="container mt-5">
                            @foreach ($stories as $item)
                            <a href="https://codepen.io/jaynewey" class="text-dark text-decoration-none">
                                <div class="post-about mb-4">
                                    <h2>CodePen</h2>
                                    <div>
                                        <span class="post-tag">Bootstrap</span>
                                    </div>
                                    <div class="mb-1 text-muted">1st June 2020</div>
                                    <p>Lorem ipsum dolor sit amet...</p>
                                    <small class="text-muted">Last updated: 1st June 2020</small>
                                </div>
                            </a>
                            @endforeach
                        </div>

                        {!! $stories->appends(['search' => Request::get('search')])->render() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
