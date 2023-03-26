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
        'send_emails',
        'code_id',
        'full_name',
    ];


    protected $casts = [
        'has_material' => 'boolean',
        'send_emails' => 'boolean',
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

    public function getCodeIdAttribute()
    {
        return $this->attributes['code_id'] ?? '-';
    }

    public function createPdf($crud = false): string
    {
        return "<a class='btn btn-sm btn-link' target='_blank' href='/{$crud->route}/{$this->attributes['id']}/pdf' data-toggle='tooltip' title='Crear PDF'><i class='la la-file-pdf'></i> PDF</a>";
    }
}
