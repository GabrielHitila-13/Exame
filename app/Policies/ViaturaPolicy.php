<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Viatura;

class ViaturaPolicy
{
    /**
     * Determina se o usuário pode registrar viaturas.
     */
    public function create(User $user)
    {
        return $user->role === 'secretario';
    }

    /**
     * Determina se o usuário pode alterar o estado da viatura.
     */
    public function updateStatus(User $user, Viatura $viatura)
    {
        return $user->role === 'tecnico';
    }

    /**
     * Determina se o usuário pode ver o estado da viatura (somente clientes e técnicos).
     */
    public function view(User $user, Viatura $viatura)
    {
        return $user->role === 'cliente' || $user->role === 'tecnico';
    }
    protected $policies = [
        Viatura::class => ViaturaPolicy::class,
    ];
    
}
