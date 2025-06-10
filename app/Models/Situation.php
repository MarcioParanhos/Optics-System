<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Frame;

class Situation extends Model
{
    use HasFactory;

    protected function translatedName(): Attribute
    {
        return Attribute::make(
            get: fn () => match (strtolower($this->name)) {
                'active'   => 'Ativo',
                'inactive' => 'Inativo',
                default    => $this->name,
            },
        );
    }
    public function frames(): HasMany
    {
        // O Laravel assume a chave estrangeira 'situation_id' no modelo Frame.
        return $this->hasMany(Frame::class);
    }
}