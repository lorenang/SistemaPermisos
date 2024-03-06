<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
class Roles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $role;
    public $detail;

    public function render()
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate(15);
        return view('livewire.roles.roles', [
            'roles' => $roles,
        ]);
    }

    public function saveRole() {
        $nombreRole = $this->role; // Aquí establece el nombre del permiso
        $guardName = 'web'; // Aquí establece el nombre de la guardia

        $user = Auth::user(); // Obtiene el usuario actualmente autenticado

        $role = Role::create([
            'name' => $nombreRole,
            'guard_name' => $guardName,
            'detail' => $this->detail,
            'usuario' => $user->abrevia // Aquí establecemos el nombre del usuario
        ]);
        $this->resetField();
        session()->flash('role', 'Rol creado');
    }

    private function resetField() {
        $this->role = ''; 
        $this->detail = ''; 
    }
}
