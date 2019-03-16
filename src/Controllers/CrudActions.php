<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

/**
 * CrudActions
 *
 *
 * @author      Ray
 * @version     1.0
 * @deprecated  since 190316
 *
 */
trait CrudActions
{
    use ContentHeader;
    protected $mainModel;

    protected function setMainModel($mainModel = null)
    {
        $this->mainModel = $mainModel;
        return $this;
    }
    /**
     * Index interface.
     *
     * @return Content
     */
    protected function crudIndex()
    {
        $this->setDescription(trans('admin.list'));
        return $this->content()->body($this->grid());
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    protected function crudCreate()
    {
        $this->setDescription(trans('admin.new'));
        return $this->content()->body($this->form());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\Http\JsonResponse
     */
    protected function crudStore()
    {
        return $this->form()->store();
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    protected function crudEdit($id)
    {
        $this->setDescription(trans('admin.edit'));
        return $this->content()->body($this->form()->edit($id));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function crudUpdate($id)
    {
        return $this->form()->update($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    protected function crudDestroy($id)
    {
        if ($this->form()->destroy($id)) {
            $data = [
                'status'  => true,
                'message' => trans('admin.delete_succeeded'),
            ];
        } else {
            $data = [
                'status'  => false,
                'message' => trans('admin.delete_failed'),
            ];
        }

        return response()->json($data);
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     *
     * @return Content
     */
    protected function crudShow($id)
    {
        $this->setDescription(trans('admin.detail'));
        return $this->content()->body($this->detail($id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid|string
     */
    protected function grid()
    {
        if (!$this->mainModel)  return '未定义MainModel';

        $grid = new Grid($this->mainModel);

        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disablePagination();
        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();
            $filter->like('title');
        });
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });

        $grid->column('id')->sortable();
        $grid->column('title');

        return $grid;
    }
    /**
     * Make a form builder.
     *
     * @return Form|string
     */
    protected function form()
    {
        if (!$this->mainModel)  return '未定义MainModel';

        $form = new Form($this->mainModel);

        $form->disableEditingCheck();
        $form->disableViewCheck();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        //$form->display('id');
        $form->text('title')->rules('required');
        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        return $form;
    }
    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show|string
     */
    protected function detail($id)
    {
        if (!$this->mainModel)  return '未定义MainModel';

        $show = new Show($this->mainModel->findOrFail($id));

        $show->field('id');
        $show->field('title');
        $show->field('created_at');

        return $show;
    }
}
