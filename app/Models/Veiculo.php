<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca',
        'modelo',
        'cor',
        'tipo',
        'estado',
        'tipo_avaria',
        'codigo_validacao',
        'user_id'
    ];

    /**
     * Relacionamento: um veículo pertence a um usuário (cliente).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    // Gerar código de validação único ao criar um novo veículo
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($veiculo) {
            $veiculo->codigo_validacao = strtoupper(Str::random(10)); // Gera um código aleatório de 10 caracteres
        });
    }
}
