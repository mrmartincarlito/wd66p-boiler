<?php 

interface IBase
{
    /**
     * Show all values
     *
     * @return void
     */
    function index();

    /**
     * Store or Insert values
     *
     * @return void
     */
    function store($data);

    /**
     * Show only 1 value
     *
     * @param [type] $id
     * @return void
     */
    function show($id);

    /**
     * Update a value with an id
     *
     * @param [type] $id
     * @param [type] $data
     * @return void
     */
    function update($id, $data);

    /**
     * Delete a value
     *
     * @param [type] $id
     * @return void
     */
    function destroy($id);
}