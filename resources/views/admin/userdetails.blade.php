

@extends('admin.maindesign')

@section('user_details')
<div class="container mt-4">
    <h2 class="h4">User Details</h2>

    <div class="card bg-dark text-white p-4 mt-3">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Registered At:</strong> {{ $user->created_at }}</p>

        <a href="{{ route('admin.viewusers') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>
@endsection


 