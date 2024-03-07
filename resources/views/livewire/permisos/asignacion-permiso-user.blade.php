<div>
    <h4 class="text-center mt-2">ASIGNACION DE PERMISOS A PERSONAS</h4>
    @if (session('permisos_users'))
        <div class="alert alert-success mt-2">
            {{ session('permisos_users') }}
        </div>
    @endif
    <form class="row" wire:submit.prevent="savePermisoUser">
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
        <div class="col-5 p-2">
            <input type="text" class="form-control" id="searchUser" name="searchUser" placeholder="Ingrese el nombre la persona" wire:model="searchUser">
            @if ($searchUser !== null)
            <select name="user" id="user" class="form-select mt-1" wire:model="user">
                <option value="" selected>Seleccione una opcion</option>
                @foreach ($users as $user) 
                    <option value="{{$user->codigoe}}">{{$user->apellido}}</option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
 
</div>
