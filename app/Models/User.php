<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $connection='sqlsrvPersonal';
    protected $table = 'VistaUsuarios';
    protected $fillable = [
        'codigoe',
        'apellido',
        'nrodoc',
        'abrevia',
        'clavencrypt',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'clavencrypt',
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'codigoe';

    /**
     * The column name of the "username".
     *
     * @var string
     */
    protected $username = 'abrevia';

    /**
     * The column name of the "password".
     *
     * @var string
     */
    protected $password = 'clavencrypt';


}
