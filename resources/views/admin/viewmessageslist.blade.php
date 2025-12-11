@extends('admin.maindesign')

@section('dashboard')

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Customer Contact Messages</h3>
        </div>
        <div class="card-body">

            {{-- Display Success/Error Messages (Optional, but highly recommended) --}}
            @if(Session::has('success_message'))
                <div class="alert alert-success">{{ Session::get('success_message') }}</div>
            @endif
            @if(Session::has('error_message'))
                <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
            @endif

            @if($messages->isEmpty())
                <div class="alert alert-info">
                    Wala pang natatanggap na contact messages.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date Received</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $index => $message)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>{{ $message->created_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" 
                                                data-toggle="modal" 
                                                data-target="#messageModal{{ $message->id }}">
                                            View
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- MODAL PARA SA BUONG MESSAGE AT REPLY FORM --}}
                @foreach($messages as $message)
                <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                    
                    <div class="modal-dialog modal-dialog-slideout" role="document"> 
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">Message from: {{ $message->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            {{-- REPLY FORM START --}}
                            <form action="{{ route('admin.reply_message', $message->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    
                                    <h4>Original Message Details</h4>
                                    <p><strong>To Email:</strong> {{ $message->email }}</p>
                                    <p><strong>Subject:</strong> {{ $message->subject }}</p>
                                    <hr>
                                    <p><strong>Message:</strong></p>
                                    <div class="alert alert-secondary p-3 text-dark">{{ $message->message }}</div> 
                                    
                                    <hr>
                                    <h4>Your Reply</h4>
                                    
                                    <div class="form-group">
                                        {{-- I-SIMPLIFY: Ginawa lang "Subject" --}}
                                        <label for="reply_subject">Subject:</label>
                                        <input type="text" name="reply_subject" class="form-control" value="Re: {{ $message->subject }}">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="reply_message">Reply Content:</label>
                                        <textarea name="reply_message" class="form-control" rows="5" required></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Send Reply</button> 
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                @endforeach
            @endif

        </div>
    </div>
</div>

@endsection