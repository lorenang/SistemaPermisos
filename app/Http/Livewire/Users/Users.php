<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class Users extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    public function render()
    {
        if (!empty($this->search)) {
            $users = User::where('apellido', 'LIKE', '%' . $this->search . '%')
                ->orWhere('abrevia', 'LIKE', '%' . $this->search . '%')
                ->paginate(15);
        } else {
            $users = User::paginate(15);
        }
    
        return view('livewire.users.users', [
            'users' => $users,
        ]);
    }
}
