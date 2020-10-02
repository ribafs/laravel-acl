# Views

Vejamos duas views como exemplo das views do pacote.

Nosso pacote conta com um layout customizado e com as views home.blade.php e welcome.blade.php.

## View index típica

### Controle de acesso geral

O controle de acesso geral é para as 3 roles: super, manager e user

## Controle de acesso específico

Mas o controle para todos os botões (new, view, edit e delete) e do form Search é permitido apenas para os users: super e manager. O user com role user não tem acesso a estes itens.

### Customização

Logo que o ribafs/laravel-acl é instalado, publicado e inteiramente configurado, todas as permissões nas views estão assim
```php
            @role('super', 'admin')
```
Assim somente um super ou admin tem acesso a tudo.

Então precisará ajustar de acordo com suas necessidades e usuários existentes.

### Necessidades e criatividade

Estas motivarão você para as customizações.

## Permissões default

Por padrão eu pensei assim nas permissões de cada role:
```php
- super: pode tudo, sem exceção no aplicativo
- admin: pode tudo mas somente nas tabelas administrativas: users, roles e permissions
- manager: pode tudo nas tabelas tipo de negócio: clients
- user: pode somente logar e acessar o index de clients e com restrições

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @role('super', 'manager', 'user')
            <div class="col-md-9">
                <div class="card">
                    @role('super', 'manager')
                    <div class="card-header">Clients</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/clients/create') }}" class="btn btn-success btn-sm" title="Add New Client">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/clients') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    @endrole
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Name</th><th>Email</th>@role('super', 'manager')<th>Actions</th>@endrole
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->email }}</td>
                                        <td>
                                @role('super', 'manager')
                                            <a href="{{ url('/admin/clients/' . $item->id) }}" title="View Client"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/clients/' . $item->id . '/edit') }}" title="Edit Client"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/clients' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Client" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                @endrole
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $clients->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
@endsection
```

## Uma típica edit.blade.php

Veja que o acesso desta view é somente para os users das roles super e manager. super pode tudo e manager pode tudo na clients.

Se fosse uma edit.blade.php da users, roles ou permissions eu mudaria o controle para:
```php
            @role('super', 'admin')

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            @role('super', 'manager')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Client #{{ $client->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/clients') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/clients/' . $client->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.clients.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
@endsection
```

