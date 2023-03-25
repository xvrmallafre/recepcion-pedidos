<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recepcion;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Class RecepcionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RecepcionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Recepcion::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/recepcion');
        CRUD::setEntityNameStrings('recepción', 'recepciones');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'code_id',
            'label' => 'Código',

        ]);
        $this->crud->addColumn([
            'name' => 'full_name',
            'label' => 'Nombre completo',
        ]);
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

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
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
            ->validationRules('max:200|email')
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
            ])
            ->tab('Estado');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function generatePdf(string $id)
    {
        $recepcion = Recepcion::find($id);
        $pdf = PDF::loadView('pdf.recepcion', compact('recepcion'))->setPaper('a4');
        return $pdf->stream('recepcion-'.$recepcion->code_id.'.pdf');
    }
}
