@extends('layots\app')
@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
@section('content')
    @props(['users'])












<div class="container">
    <h2>Hover Rows</h2>
    <p>The .table-hover class enables a hover state on table rows:</p>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Firstname</th>
          <th>Email</th>

          <th>
          action
          </th>
        </tr>
      </thead>
      <tbody>

        <tr>
            <tr>
                @foreach ($users as $user)
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>
                        <a href="#editUser" data-toggle="modal" class="edit"><i
                            class="material-icons"  title="Edit">&#xE254;</i></a>
                    </td>
            </tr>

            <script>
                function editUser(userId) {
                    alert(userId);
                }
            </script>
        </tr>
        @endforeach

      </tbody>
    </table>
    
  </div>

  <div id="editUser" class="modal fade">
    <div class="modal-dialog custom-modal-dialog">
        <div class="modal-content">
            <form action="{{route('users.edit',$user->id)}}" method="post">
                @csrf
                @method('post')
                <div class="modal-header">
                    <h4 class="modal-title">Edit Usert</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{$user->name}}" required="required">
                        <input type="hidden" name="id" value="">
                        <input type="text" class="form-control" name="name" value=""
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success"
                        onclick="showNotification('Category updated successfly')" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>
  @endsection
