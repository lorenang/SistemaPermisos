<div class="row">
    <div class="col-8">
        @if ($roles->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>Detalle</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>{{$role->detail}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        <div class="row justify-content-center">
            <span class="m-2">No existen roles</span>
        </div>
        @endif
        <div class="card-footer">
            {{$roles->links()}}
        </div>
    </div>

    <div class="col-4 border mt-2">
        @if (session('role'))
            <div class="alert alert-success mt-2">
                {{ session('role') }}
            </div>
        @endif
        <form wire:submit.prevent="saveRole" class="row p-2"> 
            <h4 class="text-center border-bottom">Nuevo rol</h4>
            <div class="p-2">
                <label for="role">Nombre del rol</label>
                <input type="text" id="role" name="role" class="form-control" wire:model="role">
            </div>
            <div class="p-2">
                <label for="detail">Detalle</label>
                <input type="text" id="detail" name="detail" class="form-control" wire:model="detail">
            </div>
            <div class="text-center">
                <span class="form-text text-danger">Corrobore la informacion ingresada</span>
                <br>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

    <div class="col-12 border mt-2">
        @livewire('roles.asignacion-role-permisos')
        @livewire('roles.asignacion-role-user')
    </div>

</div>
