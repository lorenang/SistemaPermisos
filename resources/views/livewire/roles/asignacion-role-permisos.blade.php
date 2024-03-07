<div>
    <h4 class="text-center mt-2">ASIGNACION DE PERMISOS A ROLES</h4>
    @if (session('role_permisos'))
        <div class="alert alert-success mt-2">
            {{ session('role_permisos') }}
        </div>
    @endif
    <form class="row" wire:submit.prevent="saveRolePermiso">
        <div class="col-5 p-2">
            <input type="text" class="form-control" id="searchRole" name="searchRole" wire:model="searchRole" placeholder="Ingrese el nombre de un rol">
            @if ($searchRole !== null) 
                <select name="role" id="role" class="form-select mt-1" wire:model="role">
                    <option value="" selected>Seleccione una opcion</option>
                    @foreach ($roles as $role) 
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <div class="col-5 p-2">
            <input type="text" class="form-control" id="searchPermiso" name="searchPermiso" wire:model="searchPermiso" placeholder="Ingrese el nombre de un permiso">
            @if ($searchPermiso !== null)
            <select name="permiso" id="permiso" class="form-select mt-1" wire:model="permiso">
                <option value="" selected>Seleccione una opcion</option>
                @foreach ($permissions as $permiso) 
                    <option value="{{$permiso->id}}">{{$permiso->name}}</option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>