@extends ('admin.maindesign')

@section('view_category')

@if(session('deletecategory_message'))
    <div style="margin-bottom: 10px; color: black; background-color: orangered;">
        {{ session('deletecategory_message') }}
    </div>
@endif

<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Category ID</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Category</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($categories as $category)
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 12px;">{{ $category->id }}</td>
            <td style="padding: 12px;">{{ $category->category }}</td>
            <td style="padding: 12px;">
                <a href="{{ route('admin.categoryupdate', $category->id) }}"style=color:green;
                   style="color: red; text-decoration:none;"
                   >
                    update
                    <a href="{{ route('admin.categorydelete', $category->id) }}"
                   style="color: red; text-decoration:none;"
                   onclick="return confirm('Are you sure?')">
                    Delete
                </a>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
