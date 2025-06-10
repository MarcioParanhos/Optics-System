<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Situation;


class Frame extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Retorna o texto do status (Ativo/Inativo).
     */
    protected function statusText(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->situation_id === 1 ? 'Ativo' : 'Inativo',
        );
    }

    /**
     * Retorna a classe CSS correspondente ao status.
     */
    protected function statusClass(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->situation_id === 1 ? 'bg-green' : 'bg-danger',
        );
    }

    public function situation(): BelongsTo
    {
        // O Laravel assume que a chave estrangeira é 'situation_id'.
        // Se fosse diferente, você passaria como segundo argumento.
        return $this->belongsTo(Situation::class);
    }
}
