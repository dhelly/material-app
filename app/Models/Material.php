<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Material extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'descricao',
        'sala',
        'tombo',
        'orgao',
        'marca',
        'modelo',
        'responsavel',
        'origem',
        'estado',
        'observacao',
        'user_id',
        'personal',
        'annotation',
        'devolution'];

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this
    //         ->addMediaConversion('preview')
    //             ->width(300)
    //             ->height(300)
    //             ->sharpen(10)
    //         ->performOnCollections('default');
    // }

    public function salas()
    {
        return Material::get('sala');
    }
}
