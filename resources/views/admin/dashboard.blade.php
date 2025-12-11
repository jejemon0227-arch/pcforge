@extends('admin.maindesign')

@section('dashboard')
<div class="container-fluid">
    <div class="row">
        <!-- Existing Stats Cards -->
        <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                        <div class="icon"><i class="icon-user-1"></i></div><strong>New Clients</strong>
                    </div>
                    <div class="number dashtext-1">27</div>
                </div>
                <div class="progress progress-template">
                    <div role="progressbar" style="width: 30%" class="progress-bar progress-bar-template dashbg-1"></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                        <div class="icon"><i class="icon-contract"></i></div><strong>New Projects</strong>
                    </div>
                    <div class="number dashtext-2">375</div>
                </div>
                <div class="progress progress-template">
                    <div role="progressbar" style="width: 70%" class="progress-bar progress-bar-template dashbg-2"></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                        <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>New Invoices</strong>
                    </div>
                    <div class="number dashtext-3">140</div>
                </div>
                <div class="progress progress-template">
                    <div role="progressbar" style="width: 55%" class="progress-bar progress-bar-template dashbg-3"></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="statistic-block block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                        <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All Projects</strong>
                    </div>
                    <div class="number dashtext-4">41</div>
                </div>
                <div class="progress progress-template">
                    <div role="progressbar" style="width: 35%" class="progress-bar progress-bar-template dashbg-4"></div>
                </div>
            </div>
        </div>

        <!-- New Messages Card -->
        <div class="col-md-3 col-sm-6 mt-3">
            <div class="statistic-block block">
                <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                        <div class="icon"><i class="icon-envelope"></i></div><strong>New Messages</strong>
                    </div>
                    <div class="number dashtext-5">{{ \App\Models\ContactMessage::count() }}</div>
                </div>
                <div class="progress progress-template">
                    <div role="progressbar" style="width: 50%" class="progress-bar progress-bar-template dashbg-5"></div>
                </div>
               <a href="{{ route('admin.contact_messages') }}" class="btn btn-sm btn-light mt-2">View Messages</a>
            </div>
        </div>
    </div>
</div>
@endsection
