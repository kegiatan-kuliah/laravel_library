<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TransactionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Barryvdh\DomPDF\Facade\Pdf;
/**
 * Class TransactionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransactionCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Transaction::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/transaction');
        CRUD::setEntityNameStrings('transaction', 'transactions');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addButtonFromModelFunction('top', 'export_button', 'export', 'end');
        CRUD::column([
            'label' => 'Transaction Date',
            'name' => 'transaction_date',
            'type' => 'date'
        ]);
        CRUD::column([
            'name'        => 'transaction_type',
            'label'       => 'Type',
            'type'        => 'select_from_array',
            'options'     => ['borrow' => 'Borrow', 'return' => 'Return'],
        ]);
        CRUD::column([
            'label' => 'Due Date',
            'name' => 'due_date',
            'type' => 'date'
        ]);
        CRUD::column([
            'label' => 'Return Date',
            'name' => 'return_date',
            'type' => 'date'
        ]);
        CRUD::column([
            'label' => 'Book',
            'name' => 'book.title',
            'type' => 'text'
        ]);
        CRUD::column([
            'label' => 'Member',
            'name' => 'member.name',
            'type' => 'text'
        ]);
        CRUD::column([
            'label' => 'Late Fee',
            'name' => 'late_fee',
            'type' => 'text'
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::column([
            'label' => 'Transaction Date',
            'name' => 'transaction_date',
            'type' => 'date'
        ]);
        CRUD::column([
            'name'        => 'transaction_type',
            'label'       => 'Type',
            'type'        => 'select_from_array',
            'options'     => ['borrow' => 'Borrow', 'return' => 'Return'],
        ]);
        CRUD::column([
            'label' => 'Due Date',
            'name' => 'due_date',
            'type' => 'date'
        ]);
        CRUD::column([
            'label' => 'Return Date',
            'name' => 'return_date',
            'type' => 'date'
        ]);
        CRUD::column([
            'label' => 'Book',
            'name' => 'book.title',
            'type' => 'text'
        ]);
        CRUD::column([
            'label' => 'Member',
            'name' => 'member.name',
            'type' => 'text'
        ]);
        CRUD::column([
            'label' => 'Late Fee',
            'name' => 'late_fee',
            'type' => 'text'
        ]);
        CRUD::column([
            'name'  => 'created_at', // The db column name
            'label' => 'Created At', // Table column heading
            'type'  => 'date'
        ]);
        CRUD::column([
            'name'  => 'updated_at', // The db column name
            'label' => 'Updated At', // Table column heading
            'type'  => 'date'
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TransactionRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        CRUD::field([  // Select
            'label'     => "Member",
            'type'      => 'select',
            'name'      => 'member_id', // the db column for the foreign key
            'entity'    => 'Member',
            'model'     => "App\Models\Member", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'Desc')->get();
             })
        ]);

        CRUD::field([  // Select
            'label'     => "Book",
            'type'      => 'select',
            'name'      => 'book_id', // the db column for the foreign key
            'entity'    => 'Book',
            'model'     => "App\Models\Book", // related model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('id', 'Desc')->get();
             })
        ]);
        CRUD::field([
            'name'        => 'transaction_type',
            'label'       => 'Type',
            'type'        => 'select_from_array',
            'options'     => ['borrow' => 'Borrow', 'return' => 'Return'],
        ]);
        CRUD::field([
            'name'        => 'late_fee',
            'label'       => 'Late Fee',
            'type'        => 'number',
        ]);
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

    public function export()
    {
        $transactions = \App\Models\Transaction::orderBy('id','desc')->get();   
        $pdf = Pdf::loadView('export.transaction',['transactions' => $transactions]);
        return $pdf->stream();
    }
}
