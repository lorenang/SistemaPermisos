<?php

namespace App\Http\Livewire\Permisos;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Permisos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $permiso;
    public $detail;

    public function render()
    { 
        $permissions = Permission::orderBy('created_at', 'desc')->paginate(15);
        return view('livewire.permisos.permisos', [
            'permissions' => $permissions,
        ]);
    }

    public function savePermiso() {
        $nombrePermiso = $this->permiso; // Aquí establece el nombre del permiso
        $guardName = 'web'; // Aquí establece el nombre de la guardia

        $user = Auth::user(); // Obtiene el usuario actualmente autenticado

        $permiso = Permission::create([
            'name' => $nombrePermiso,
            'guard_name' => $guardName,
            'detail' => $this->detail,
            'usuario' => $user->abrevia // Aquí establecemos el nombre del usuario
        ]);
        $this->resetField();
        session()->flash('permission', 'Permiso creado');
    }

    private function resetField() {
        $this->permiso = ''; 
        $this->detail = ''; 
    }
}
