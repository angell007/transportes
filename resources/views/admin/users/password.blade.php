@extends('laracrud::layouts.modal')

@section('title', 'User Password')
@section('content')
    <form method="POST" action="{{ route('admin.users.password', $user->id) }}" data-ajax-form>
        @csrf
        @method('PATCH')

        <div class="modal-body">
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control">
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-round btn-primary">Save</button>
            <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>
@endsection