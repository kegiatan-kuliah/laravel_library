<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GuestBookRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GuestBookCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GuestBookCrudController extends CrudController
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
        CRUD::setModel(\App\Models\GuestBook::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/guest-book');
        CRUD::setEntityNameStrings('guest book', 'guest books');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::column([
            'label' => 'Visited Date',
            'name' => 'visited_date',
            'type' => 'date'
        ]);

        CRUD::column([
            'label' => 'Name',
            'name' => 'member.name',
            'type' => 'text'
        ]);
    }

    protected function setupShowOperation()
    {

        CRUD::column([
            'label' => 'Visited Date',
            'name' => 'visited_date',
            'type' => 'date'
        ]);

        CRUD::column([
            'label' => 'Name',
            'name' => 'member.name',
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
        CRUD::setValidation(GuestBookRequest::class);
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
}
