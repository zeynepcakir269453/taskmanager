@extends('layout')
  
@section('content')
    @if ($errors->has('title'))
    <div class="alert alert-danger">
        {{ $errors->first('title') }}
    </div>
    @endif
    <div class="container">
      <a href="{{ route('task') }}" class="btn btn-primary">Back</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('task.update', $task->id) }}" data-parsley-validate
                    class="form-horizontal form-label-left" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                            >Title
                        </label>
                            <input type="text" id="title" value="{{ $task->title }}" name="title" class="form-control ">
                    </div>

                    <div class="item form-group">
                       <label class="col-form-label col-md-3 col-sm-3 label-align">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $task->description }}</textarea>
                    </div>

					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align"
                            >User
                        </label>
	                    <select class="form-control" id="user_id" name="user_id">
	                        @foreach($userlist as $userlist)
	                        <option {{ $task->user_id == $userlist['id'] ? 'selected' : '' }} value="{{ $userlist['id'] }}">
	                            {{ $userlist['name'] }}
	                        </option>
	                        @endforeach
	                    </select>
					</div>

					<div class="item form-group">
	                    <select class="form-control" id="completed" name="completed">
	                        <option {{ $task->completed == '0' ? 'selected' : '' }} value="0" >To Do</option>
	                        <option {{ $task->completed == '1' ? 'selected' : '' }} value="1">Completed</option>
	                        <option {{ $task->completed == '2' ? 'selected' : '' }} value="2">Rejected</option>
	                    </select>
					</div>

                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('task') }}" type="button"  class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection