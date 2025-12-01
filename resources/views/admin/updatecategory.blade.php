@extends('admin.maindesign')

<base href="/public">
@section('update_category')
<div class="container-fluid">
    
    @if(session('category_updated_message'))
        <div class="mb-4 bg-blue-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('category_updated_message') }}
        </div>
    @endif

    <form action="{{ route('admin.postupdatecategory',$category->id)}}" method="POST">
        @csrf
       
        <input type="text" name="category"value='{{$category->category}}'>
        <input type="submit" value="update Category">
    </form>

</div>
@endsection


