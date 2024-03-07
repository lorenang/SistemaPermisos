<div class="mt-2">
    <div class="border">
        <input class="form-control" placeholder="ingrese el nombre" wire:model="search" name="search" id="search">
    </div>

    <div class="">
        @if($users->count())
        <table class="table  table-striped">
            <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>USERNAME</th>
                    <th>CODIGOE</th>
                    <th>ROLES</th>
                    <th>PERMISOS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->apellido}}</td>
                    <td>{{$user->abrevia}}</td>
                    <td>{{$user->codigoe}}</td>
                    <td>
                        @foreach ($user->roles as $rol)
                            {{$rol->name}} ({{$rol->detail}}),
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($user->roles as $rol)
                            @foreach ($rol->permissions as $permiso)
                                {{$permiso->name}} ({{$permiso->detail}}),
                                <br>
                            @endforeach
                        @endforeach
                        @foreach ($user->permissions as $permiso)
                            {{$permiso->name}} ({{$permiso->detail}}) ,
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <span>No existen registros</span>
        @endif
    </div>
    <div class="card-footer">
        {{$users->links()}}
    </div>
</div>
