<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

trait TraitResourceActions
{
    use TraitAdminContent;
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return $this->description(trans('admin.list'))->body($this->grid());
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return $this->description(trans('admin.new'))->body($this->form());
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return $this->description(trans('admin.edit'))->body($this->form()->edit($id));
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @return Content
     */
    public function show($id)
    {
        return $this->description(trans('admin.detail'))->body($this->detail($id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid|string
     */
    protected function grid()
    {
        if (!class_exists(MainModel::class))  return '未定义模块！';

        $grid = new Grid(new MainModel());

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
        if (!class_exists(MainModel::class))  return '未定义模块！';

        $form = new Form(new MainModel());

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
        if (!class_exists(MainModel::class))  return '未定义模块！';

        $show = new Show(MainModel::findOrFail($id));

        $show->field('id');
        $show->field('title');
        $show->field('created_at');

        return $show;
    }
}
