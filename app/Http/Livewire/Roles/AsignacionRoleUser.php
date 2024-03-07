<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AsignacionRoleUser extends Component
{
    public $searchRole;
    public $role;

    public $searchUser;
    public $user;

    public function render()
    {
        $roles = Role::query();
        if ($this->searchRole) {
            $roles->whereRaw('LOWER(name) like ?', ['%' . strtolower($this->searchRole) . '%']);
        }
        $roles = $roles->get();

        $users = User::query();
        if ($this->searchUser) {
            $users->whereRaw('LOWER(apellido) like ?', ['%' . strtolower($this->searchUser) . '%']);
        }
        $users = $users->get();
        return view('livewire.roles.asignacion-role-user', [
            'roles' => $roles,
            'users' => $users,
        ]);
    }

    public function saveRoleUser() {
        if (!empty($this->user) && is_numeric($this->user) && !empty($this->role) && is_numeric($this->role)) {
            // Verificar si el permiso ya está asignado al rol
            $existingAssignment = DB::table('model_has_roles')
            ->where('role_id', $this->role)
            ->where('model_id', $this->user)
            ->exists();
            
            if (!$existingAssignment) {
                $user = Auth::user(); // Obtiene el usuario actualmente autenticado
                // Guardar la asignación del permiso al usuario en la tabla model_has_roles
                DB::table('model_has_roles')->insert([
                    'role_id' => $this->role, // ID del permiso
                    'model_type' => 'App\Models\User',
                    'model_id' => $this->user, // ID del usuario al que se le asigna el permiso
                    'usuario' => $user->abrevia, // Nombre del usuario asignador
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                $this->resetField();
                // Redireccionar o mostrar un mensaje de éxito
                session()->flash('role_user', 'Rol asignado correctamente a la persona.');
            } else {
                // Mostrar un mensaje de error si la asignación ya existe
                session()->flash('role_user', 'El rol ya está asignado a la persona.');
            }
        } else {
            session()->flash('role_user', 'Verifique los datos ingresados');
        }
    }

    private function resetField() {
        $this->searchUser = null; 
        $this->user = null; 
        $this->searchRole = null; 
        $this->role = null; 
    }
}
