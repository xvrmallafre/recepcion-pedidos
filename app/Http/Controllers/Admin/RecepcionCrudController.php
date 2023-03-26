<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recepcion;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Class RecepcionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RecepcionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(Recepcion::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/recepcion');
        CRUD::setEntityNameStrings('recepción', 'recepciones');
    }

    protected function setupListOperation()
    {
        CRUD::column('code_id')->label('Código');
        CRUD::column('full_name')->label('Nombre completo');
        CRUD::column('email')->label('Correo electrónico');
        CRUD::column('phone')->label('Teléfono');
        CRUD::column('status')->label('Estado')->wrapper([
            'element' => 'span',
            'class' => function ($crud, $column, $entry, $related_key) {
                switch ($entry->status) {
                    case 'Recibido':
                        return 'badge badge-pill badge-primary';
                    case 'Hecho':
                        return 'badge badge-pill badge-success';
                    case 'Entregado':
                        return 'badge badge-pill badge-info';
                    case 'Rechazado':
                        return 'badge badge-pill badge-danger';
                    default:
                        return 'badge badge-pill badge-secondary';
                }
            },
        ]);
        CRUD::column('created_at')->label('Fecha de creación');
        $this->crud->removeButton('show');
        $this->crud->addButtonFromModelFunction(
            'line',
            'pdf',
            'createPdf',
            'beginning'
        );
    }

    protected function commonOperations()
    {
        Widget::add()->type('script')->content('assets/js/recepcion-form.js');

        CRUD::field('name')
            ->validationRules('required|min:2|max:200')
            ->label('Nombre')
            ->tab('Datos personales')
            ->wrapperAttributes(['class' => 'form-group col-md-6']);
        CRUD::field('lastname')
            ->validationRules('required|min:2|max:200')
            ->label('Apellidos')
            ->tab('Datos personales')
            ->wrapperAttributes(['class' => 'form-group col-md-6']);
        CRUD::field('email')
            ->validationRules('max:200')
            ->label('Correo electrónico')
            ->tab('Datos personales')
            ->wrapperAttributes(['class' => 'form-group col-md-9']);
        CRUD::field('phone')
            ->validationRules('max:50')
            ->label('Teléfono')
            ->wrapperAttributes(['class' => 'form-group col-md-3'])
            ->tab('Datos personales');
        CRUD::field('send_emails')
            ->label('Enviar correos?')
            ->tab('Datos personales');
        CRUD::field('address')
            ->validationRules('max:255')
            ->label('Dirección')
            ->tab('Datos personales');
        CRUD::field('has_material')
            ->label('¿Trae material?')
            ->tab('Faena');
        CRUD::field('material')
            ->label('Material')
            ->type('textarea')
            ->attributes(['rows' => 5])
            ->tab('Faena');
        CRUD::field('description')
            ->label('Descripción')
            ->tab('Faena');
        CRUD::field('observations')
            ->label('Observaciones')
            ->tab('Faena');
        CRUD::field('status')
            ->validationRules('required|in:received,done,delivered,rejected')
            ->label('Estado')
            ->type('select_from_array')
            ->options([
                'received' => 'Recibido',
                'done' => 'Hecho',
                'delivered' => 'Entregado',
                'rejected' => 'Rechazado',
            ]);
    }

    protected function setupCreateOperation()
    {
        $this->commonOperations();
        $this->crud->removeSaveActions([
            'save_and_edit',
            'save_and_new',
            'save_and_preview'
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->commonOperations();

        $this->crud->removeSaveActions([
            'save_and_new',
            'save_and_preview'
        ]);
    }

    public function generatePdf(string $id)
    {
        $recepcion = Recepcion::find($id);
        $pdf = PDF::loadView('pdf.recepcion', compact('recepcion'))->setPaper('a4');
        return $pdf->stream('recepcion-'.$recepcion->code_id.'.pdf');
    }

    public function store()
    {
        $response = $this->traitStore();
        $recepcion = Recepcion::find($this->crud->entry->id);

        $recepcion->code_id = 'C-'.sprintf('%04d', $this->crud->entry->id);
        $recepcion->full_name = $this->crud->entry->name.' '.$this->crud->entry->lastname;
        $recepcion->save();

        $isEdit = $this->crud->getRequest()->has('id');

        if (!$isEdit) {
            session()->flash('recepcion_id', $this->crud->entry->id);
        }

        return $response;
    }
}
