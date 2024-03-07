<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AsignacionRolePermisos extends Component
{
    public $searchRole;
    public $searchPermiso;

    public $role;
    public $permiso;

    public function render()
    {
        $roles = Role::query();
        if ($this->searchRole) {
            $roles->whereRaw('LOWER(name) like ?', ['%' . strtolower($this->searchRole) . '%']);
        }
        $roles = $roles->get();

        $permissions = Permission::query();
        if ($this->searchPermiso) {
            $permissions->whereRaw('LOWER(name) like ?', ['%' . strtolower($this->searchPermiso) . '%']);
        }
        $permissions = $permissions->get();

        return view('livewire.roles.asignacion-role-permisos', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function saveRolePermiso() {
        if (!empty($this->permiso) && is_numeric($this->permiso) && !empty($this->role) && is_numeric($this->role)) {

            // Verificar si el permiso ya está asignado al rol
            $existingAssignment = DB::table('role_has_permissions')
                ->where('permission_id', $this->permiso)
                ->where('role_id', $this->role)
                ->exists();

            if (!$existingAssignment) {
                $user = Auth::user(); // Obtiene el usuario actualmente autenticado
    
                // Guardar la asignación del permiso al usuario en la tabla role_has_permissions
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $this->permiso, // ID del permiso
                    'role_id' => $this->role, // ID del permiso
                    'usuario' => $user->abrevia, // Nombre del usuario asignador
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $this->resetField();
                // Redireccionar o mostrar un mensaje de éxito
                session()->flash('role_permisos', 'Permiso asignado correctamente al rol.');
            } else {
                session()->flash('role_permisos', 'Permiso ya asignado al rol.');
            }
        } else {
            session()->flash('role_permisos', 'Verifique los datos ingresados');
        }
    }

    private function resetField() {
        $this->searchPermiso = null; 
        $this->permiso = null; 
        $this->searchRole = null; 
        $this->role = null; 
    }
}
