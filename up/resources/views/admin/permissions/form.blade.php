<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($permission->name) ? $permission->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label for="slug" class="control-label">{{ 'Slug' }}</label>
    <input class="form-control" name="slug" type="text" id="slug" value="{{ isset($permission->slug) ? $permission->slug : ''}}" >
    {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
