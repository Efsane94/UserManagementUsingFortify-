@extends('templates.main')
@section('content')
    <h1>Create New User</h1>
    <div class="card">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @include('admin.users.partials.form', ['create'=>true])
        </form>
    </div>
@endsection
