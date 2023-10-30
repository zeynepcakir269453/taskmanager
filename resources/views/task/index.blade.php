@extends('layout')
  
@section('content')
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    @if ($errors->has('title'))
    <div class="alert alert-danger">
        {{ $errors->first('title') }}
    </div>
    @endif
    <div class="container">
      <a href="{{ route('task.create') }}" class="btn btn-primary">Create</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-striped table-dark">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Title</th>
                      <th scope="col">Description</th>
                      <th scope="col">Completed</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($tasklist->count() > 0)
                      @foreach($tasklist as $rs)
                    <tr>
                      <th scope="row">{{ $rs->id }}</th>
                      <td>{{ $rs->title }}</td>
                      <td>{{ $rs->description }}</td>
                      <td> @switch($rs->completed)
                            @case(0)
                                To Do
                                @break
                            @case(1)
                                Completed
                                @break
                            @case(2)
                                Rejected
                                @break
                            @default
                                Unknown
                        @endswitch</td>
                      <td>
                          <a href="{{ route('task.edit', $rs->id) }}" type="button"  class="btn btn-warning">Edit</a>
                          <form id="delete-form-{{$rs->id}}"
                         action="{{ route('task.destroy', $rs->id) }}" method="POST"
                         type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger m-0">Sil</button>
                          </form>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td class="text-center" colspan="5">Task not found</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection