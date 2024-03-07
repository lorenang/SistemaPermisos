<div>
    <h4 class="text-center mt-2">ASIGNACION DE ROLES A PERSONAS</h4>
    @if (session('role_user'))
        <div class="alert alert-success mt-2">
            {{ session('role_user') }}
        </div>
    @endif
    <form class="row" wire:submit.prevent="saveRoleUser">
        <div class="col-5 p-2">
            <input type="text" class="form-control" id="searchRole" name="searchRole" wire:model="searchRole" placeholder="Ingrese el nombre de un rol">
            @if ($searchRole !== null)
            <select name="permiso" id="permiso" class="form-select mt-1" wire:model="role">
                <option value="" selected>Seleccione una opcion</option>
                @foreach ($roles as $role) 
                    <option value="{{$role->id}}">{{$role->name}}</option>
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
