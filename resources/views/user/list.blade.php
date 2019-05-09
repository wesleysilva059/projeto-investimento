<table class="default-table">
    <thead>
        <tr>
            <th>#</th>
            <th>CPF</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>E-mail</th>
            <th>Status</th>
            <th>Permissão</th>
            <th>Menu</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user_list as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->formatedcpf }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->formatedphone }}</td>
            <td>{{ $user->formatedbirth }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->status }}</td>
            <td>{{ $user->permission }}</td>
            <td>
                {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'DELETE']) !!}
                    {{ Form::submit('Remover')}}
                {!! Form::close()!!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>