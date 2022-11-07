<div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'form-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'form-label']) !!}
    {!! Form::file('image', ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    @if (isset($story) && $story->image)
        <br>
        <img src="{{ $story->file_path('image') }}" alt="" style="max-width: 90px; max-height: 90px; display: block;">
        <div class="form-check" style="margin-top: 10px;">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="image_delete" >Image Delete
            </label>
        </div>
    @endif
</div>

<div class="form-group{{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'Content', ['class' => 'form-label']) !!}
    {!! Form::textarea('content', null, ['class' => 'form-control crud-richtext']) !!}
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('publish_date') ? 'has-error' : ''}}">
    {!! Form::label('publish_date', 'Publish Date', ['class' => 'form-label']) !!}
    {!! Form::text('publish_date', null, ['class' => 'form-control daterangepicker-input']) !!}
    {!! $errors->first('publish_date', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
    {!! Form::select('status', [1 => 'Active', 2 => 'Inactive', 3 => 'Archived'], null, ['class' => 'form-control']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

<br>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
