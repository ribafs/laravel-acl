@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @role('super', 'admin')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Role {{ $role->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/roles') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/roles/' . $role->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/roles' . '/' . $role->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Role" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $role->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $role->name }} </td></tr><tr><th> Slug </th><td> {{ $role->slug }} </td></tr>
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
