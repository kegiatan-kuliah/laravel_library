<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BookRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BookCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BookCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Book::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/book');
        CRUD::setEntityNameStrings('book', 'books');
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
            'label' => 'Title',
            'name' => 'title',
            'type' => 'text'
        ]);

        CRUD::column([
            'label' => 'Author',
            'name' => 'author.name',
            'type' => 'text'
        ]);

        CRUD::column([
            'label' => 'Publication Year',
            'name' => 'publication_year',
            'type' => 'text'
        ]);

        CRUD::column([
            'label' => 'Genre',
            'name' => 'genre',
            'type' => 'text'
        ]);
        CRUD::column([
            'label' => 'Total Copies',
            'name' => 'total_copies',
            'type' => 'text'
        ]);
        CRUD::column([
            'label' => 'Available Copies',
            'name' => 'available_copies',
            'type' => 'text'
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::column([
            'label' => 'Title',
            'name' => 'title',
            'type' => 'text'
        ]);

        CRUD::column([
            'label' => 'Author',
            'name' => 'author.name',
            'type' => 'text'
        ]);

        CRUD::column([
            'label' => 'Publication Year',
            'name' => 'publication_year',
            'type' => 'text'
        ]);

        CRUD::column([
            'label' => 'Genre',
            'name' => 'genre',
            'type' => 'text'
        ]);
        CRUD::column([
            'label' => 'Total Copies',
            'name' => 'total_copies',
            'type' => 'text'
        ]);
        CRUD::column([
            'label' => 'Available Copies',
            'name' => 'available_copies',
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
        CRUD::setValidation(BookRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        CRUD::field([
            'label' => 'Publication Year',
            'name' => 'publication_year',
            'type' => 'number'
        ]);

        CRUD::field([
            'label' => 'Total Copies',
            'name' => 'total_copies',
            'type' => 'number'
        ]);

        CRUD::field([
            'label' => 'Available Copies',
            'name' => 'available_copies',
            'type' => 'number'
        ]);

        CRUD::field([  // Select
            'label'     => "Author",
            'type'      => 'select',
            'name'      => 'author_id', // the db column for the foreign key
            'entity'    => 'Author',
            'model'     => "App\Models\Author", // related model
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
