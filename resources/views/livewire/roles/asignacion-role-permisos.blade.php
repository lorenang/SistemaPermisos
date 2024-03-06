<div>
    <h4 class="text-center mt-2">ASIGNACION DE PERMISOS A PERSONAS</h4>
    @if (session('role_permiso'))
        <div class="alert alert-success mt-2">
            {{ session('role_permiso') }}
        </div>
    @endif
    <form class="row" wire:submit.prevent="saveRolePermiso">
        <div class="col-5 p-2">
            <input type="text" class="form-control" id="searchrole" name="searchrole" wire:model="searchrole" @if ($permiso !== null)  @else placeholder="Ingrese el nombre de un permiso" @endif>
            <select name="permiso" id="permiso" class="form-select mt-1" wire:model="permiso">
                <option value="" selected>Seleccione una opcion</option>
                @foreach ($permissions as $permiso) 
                    <option value="{{$permiso->id}}">{{$permiso->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-5 p-2">
            <input type="text" class="form-control" id="searchuser" name="searchuser" wire:model="searchuser" placeholder="Ingrese el nombre de la persona">
            <select name="user" id="user" class="form-select mt-1" wire:model="user">
                <option value="" selected>Seleccione una opcion</option>
                @foreach ($users as $user) 
                    <option value="{{$user->codigoe}}">{{$user->apellido}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>