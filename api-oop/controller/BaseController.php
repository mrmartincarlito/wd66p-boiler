<?php
include "../builder/IBase.php";

class BaseController implements IBase {

    private $object;

    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * Select * from ?
     *
     * @return void
     */
    public function index()
    {
        return $this->object->get();
    }

    /**
     * Insert into
     *
     * @param [type] $data
     * @return void
     */
    public function store($data)
    {
        return $data->save();
    }

    /**
     * Select * from table where id = ?
     *
     * @param [type] $id
     * @return void
     */
    public function show($id)
    {
        return $this->object->byId($id);
    }

    /**
     * Update
     *
     * @param [type] $id
     * @param [type] $data
     * @return void
     */
    public function update($id, $data)
    {
        $current = $this->object->byId($id);
        foreach ($data as $key => $value) {
            $current->{$key} = $value;
        }

        $current->save();
        return $current;
    }

    /**
     * Delete
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $current = $this->object->byId($id);
        return $current->delete();
    }

    public function createResponse($status, $title, $description, $data = array()) {
        $response = array();
        $response["status"] = $status;
        $response["description"] = $description;
        $response["title"] = $title;
        $response["data"] = $data;
        
        return $response;
    }
}