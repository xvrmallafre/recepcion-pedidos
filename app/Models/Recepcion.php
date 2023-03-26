<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    public $timestamps = true;

    protected $table = 'recepciones';

    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'phone',
        'address',
        'has_material',
        'material',
        'description',
        'observations',
        'status',
    ];


    protected $casts = [
        'has_material' => 'boolean',
    ];

    public function getStatusAttribute(): string
    {
        switch ($this->attributes['status']) {
            case 'done':
                return 'Hecho';
            case 'delivered':
                return 'Entregado';
            case 'rejected':
                return 'Rechazado';
            default:
                return 'Recibido';
        }
    }

    public function getCodeIdAttribute(): string
    {
        return 'C-' . sprintf('%04d', $this->attributes['id']);
    }

    public function getFullNameAttribute(): string
    {
        return $this->attributes['name'] . ' ' . $this->attributes['lastname'];
    }

    public function createPdf($crud = false): string
    {
        return "<a class='btn btn-sm btn-link' target='_blank' href='/{$crud->route}/{$this->attributes['id']}/pdf' data-toggle='tooltip' title='Crear PDF'><i class='la la-file-pdf'></i> PDF</a>";
    }
}
