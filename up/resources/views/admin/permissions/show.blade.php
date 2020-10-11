@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @role('super', 'admin')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Permission {{ $permission->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/permissions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/permissions/' . $permission->id . '/edit') }}" title="Edit Permission"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/permissions' . '/' . $permission->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Permission" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $permission->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $permission->name }} </td></tr><tr><th> Slug </th><td> {{ $permission->slug }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
@endsection
