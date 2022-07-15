<div>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            @if (\Session::has('success'))
                <div class="alert alert-success mb-2">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Users
                    <span class="float-right ms-2">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add
                            New User</button>
                    </span>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $val)
                                                @if ($val === 'superadmin')
                                                    <span class="badge bg-danger">{{ $val }}</span>
                                                @else
                                                    <span class="badge bg-primary">{{ $val }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button"
                                                class="btn btn-xs btn-outline-primary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">Action</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="">Show</a>
                                                @can('edit.users')
                                                    <a class="dropdown-item" href="">Edit</a>
                                                @endcan
                                                @can('delete.users')
                                                    {!! Form::open(['method' => 'DELETE', 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'dropdown-item']) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('auth::livewire.users.create')
</div>
