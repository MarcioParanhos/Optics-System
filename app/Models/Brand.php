<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function frames()
    {
        return $this->hasMany(Frame::class);
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
}
