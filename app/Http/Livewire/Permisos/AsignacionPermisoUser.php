<?php

namespace App\Http\Livewire\Permisos;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AsignacionPermisoUser extends Component
{
    public $searchpermiso;
    public $permiso;
    
    public $searchuser;
    public $user;

    public function render()
    {
        $permissions = Permission::query();
        if ($this->searchpermiso) {
            $permissions->whereRaw('LOWER(name) like ?', ['%' . strtolower($this->searchpermiso) . '%']);
        }
        $permissions = $permissions->get();

        $users = User::query();
        if ($this->searchuser) {
            $users->whereRaw('LOWER(apellido) like ?', ['%' . strtolower($this->searchuser) . '%']);
        }
        $users = $users->get();
        return view('livewire.permisos.asignacion-permiso-user', [
            'permissions' => $permissions,
            'users' => $users,
        ]);
    }


    public function savePermisoUser()
    {
        if (!empty($this->user) && is_numeric($this->user) && !empty($this->permiso) && is_numeric($this->permiso)) {
            $user = Auth::user(); // Obtiene el usuario actualmente autenticado

            // Guardar la asignación del permiso al usuario en la tabla model_has_permissions
            DB::table('model_has_permissions')->insert([
                'model_type' => 'App\Models\User', // O el modelo correspondiente si no es User
                'model_id' => $this->user, // ID del usuario al que se le asigna el permiso
                'permission_id' => $this->permiso, // ID del permiso
                'usuario' => $user->abrevia, // Nombre del usuario asignador
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->resetField();
            // Redireccionar o mostrar un mensaje de éxito
            session()->flash('permisos_users', 'Permiso asignado correctamente al usuario.');
        } else {
            session()->flash('permisos_users', 'Verifique los datos ingresados');
        }
    }

    private function resetField() {
        $this->searchpermiso = ''; 
        $this->permiso = ''; 
        $this->searchuser = ''; 
        $this->user = ''; 
    }
}
