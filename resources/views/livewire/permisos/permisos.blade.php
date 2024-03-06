<div class="row">
    <div class="col-8">
        @if ($permissions->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>Detalle</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->detail}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        <div class="row justify-content-center">
            <span class="m-2">No existen permisos</span>
        </div>
        @endif
        <div class="card-footer">
            {{$permissions->links()}}
        </div>
    </div>

    <div class="col-4 border mt-2">
        @if (session('permission'))
            <div class="alert alert-success mt-2">
                {{ session('permission') }}
            </div>
        @endif
        <form wire:submit.prevent="savePermiso" class="row p-2"> 
            <h4 class="text-center border-bottom">Nuevo permiso</h4>
            <div class="p-2">
                <label for="permiso">Nombre del permiso</label>
                <input type="text" id="permiso" name="permiso" class="form-control" wire:model="permiso">
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
        @livewire('permisos.asignacion-permiso-user')
    </div>

</div>
