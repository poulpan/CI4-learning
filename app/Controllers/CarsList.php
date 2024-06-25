<?php

namespace App\Controllers;

use App\Models\CarsListModel;
use App\Entities\CarsListEntity;
use CodeIgniter\Exceptions\PageNotFoundException;

class CarsList extends BaseController
{
    private CarsListModel $model;  // add a private property to store the model object

    public function __construct()  // add teh constructor method to create a new carslist model object and assign it to the property
    {
        $this->model = new CarsListModel;
    }

    public function index()
    {
        // $db = db_connect();
        // $db->listTables();  // you can run this two commands to check if there is an error connection to the db before i.e. using migration method

        // $model = new CarsListModel;  // Now that we created a constructor function we don't need this line to create a new object

        // $data = $model->findAll();  // and we can call the findAll method on the property instead, like below:

        $data = $this->model->findAll();

        // var_dump($data);
        // exit;  // ci4 has an inbuild function (below) that does these two command at once (short for dump & die!)

        // dd($data); // this debuging tool is amazing!! (dump & die)

        // return view('CarsList/index', ['title' => 'Cars List']);  // we don't need to pass the title after we used layouts, we get it dynamically
        return view('CarsList/index', [
            'carslist' => $data
        ]);
    }

    public function show($id)
    {
        // $model = new CarsListModel;  // same here as in index above

        // $record = $model->find($id);

        // **HERE** $record = $this->model->find($id);
        /*
        if I want to use the inbuild function find() above, I need to assosiate first in the Models/CarsListModel that my primaryKey is cl_id
        otherwise I could use the where function like below to specify both my db column name and the passing variable $id
        */
        // $record = $model->where('cl_id', $id)->first();

        // **HERE** if ($record === null) {
        //     throw new PageNotFoundException('Record with id '.$id.' not found');
        // }

        // instead of checking in each method that requires an existing record, we make a private method that we can use
        // so the **HERE** $record and if check are not needed. instead we use the perivate method we've created:
        $record = $this->getRecordOr404($id);

        return view('CarsList/show', [
            'record' => $record
        ]);
    }

    public function new()
    {
        // when we moved the form to another file, cause it has record values for edit file, we also need to specify empty record values for the new file
        // return view('CarsList/new', [
        //     'record' => [
        //         'cl_brand' => "",
        //         'cl_model' => "",
        //         'cl_color' => "",
        //         'cl_year' => ""
        //     ]
        // ]);  // we removed this cause we made an entity to pass all the data instead of an array as an object, so we need to change this accordingly
        // Note: after we've created the entity we had to change all array values in view files to objects as well
        // (i.e. from: $record=['cl_year'] ,to: $record->cl_year)
        return view('CarsList/new', [
            'record' => new CarsListEntity
        ]);
    }

    public function create()
    {
        // $model = new CarsListModel;

        $record = new CarsListEntity($this->request->getPost());

        $id = $this->model->insert($record);

        if ($id === false) {

            return redirect()->back()
                             ->with('errors', $this->model->errors())  // rules for errors are done in the Model, so we could use'em again in another Controller
                             ->withInput();  // same specified messages instead of the automated ones can be done in the Model

        }

        return redirect()->to('carslist/'.$id)
                         ->with('message', 'Car record saved.');  /* we could present this message in the redirect page, but as we might have lots of
                                                                     these messages from other methods, we could all present them in the main layout,
                                                                     as long as they have the same name 'message'. */
    }

    public function edit($id)
    {
        // $model = new CarsListModel;

        // **HERE** $record = $this->model->find($id);
        $record = $this->getRecordOr404($id);

        return view('CarsList/edit', [
            'record' => $record
        ]);
    }

    public function update($id)
    {
        // $model = new CarsListModel;

        // $record = new CarsListEntity($this->request->getPost());  // a better way to do it is to find the record and then fill table's columns with the Post we got from user.
        // **HERE** $record = $this->model->find($id);
        $record = $this->getRecordOr404($id);
        $record->fill($this->request->getPost());

        $record->__unset('_method');  // need this after getting here from PATCH or PUT to alleviate the error msg when no changes are made after edit
                                      /* In more details, the error happens cause we use fill above with all the POST values, but because of spoofing in the form we also pass the value="_method" and this value is not in the allowed fields property of the model. So we just unset it here! */

        if (!$record->hasChanged()) {  // with the new save method we need to check if changes have been made in the form to avoid error

            return redirect()->back()
                             ->with('message', 'No changes have been made.');
        }

        // if ($model->update($id, $record)) {  // if we use the find-fill method, we could also use save method instead of update for shorter
        // Note: save method can also be used for inserts BUT don't forget to get the insert ID from the property first (find($id)), as the save just returns a boolean value!
        if ($this->model->save($record)) {

            return redirect()->to('carslist/'.$id)
                             ->with('message', 'Car record updated.');
        }

        return redirect()->back()
                         ->with('errors', $this->model->errors())  // rules for errors are done in the Model, so we could use'em again in another Controller
                         ->withInput();
    }

    // as the 7 RESTful routes include just a delete method and not for a confirmation, we'll make a separate method for confirming deletion as well as a separate route for it.
    public function confirmDelete($id)
    {
        $record = $this->getRecordOr404($id);

        return view('CarsList\delete', [
            'record' => $record
        ]);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('carslist')
                         ->with('message', 'Record deleted.');
    }

    private function getRecordOr404($id): CarsListEntity
    {
        $record = $this->model->find($id);
        
        if ($record === null) {
            throw new PageNotFoundException('Record with id '.$id.' not found');
        }

        return $record;
    }
}
