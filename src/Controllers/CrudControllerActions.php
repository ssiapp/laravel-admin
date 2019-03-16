<?php
namespace Encore\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

/**
 * CrudControllerActions
 *
 *
 * @author      Ray
 * @version     1.0
 * @deprecated  since 190316
 *
 */
trait CrudControllerActions
{
    use CrudActions;

    /**
     * @return \Encore\Admin\Layout\Content
     */
    public function index()
    {
        return $this->crudIndex();
    }
    public function create()
    {
        return $this->crudCreate();
    }
    public function store()
    {
        return $this->crudStore();
    }
    public function edit($id)
    {
        return $this->crudEdit($id);
    }
    public function update($id)
    {
        return $this->crudUpdate($id);
    }
    public function destroy($id)
    {
        return $this->crudDestroy($id);
    }
    public function show($id)
    {
        return $this->crudShow($id);
    }
}
