<?php

namespace Dcat\Admin\Category\Http\Controllers;


use Dcat\Admin\Category\Models\Category;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;
use Dcat\Admin\Widgets\Modal;

class CategoryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $table = request('table', '');

        return Grid::make(new Category(), function (Grid $grid) use ($table) {
            if (!empty($table)) {
                $grid->disableCreateButton();
                $url = request()->url().'/create?table='.$table;
                $grid->tools("<a class='btn btn-primary btn-outline' href='{$url}'><i class='feather icon-plus'></i><span class='d-none d-sm-inline'>新增分类</span></a>");
                $grid->model()->where('table_text', $table);
            } else {
                $grid->model()->whereNull('table_text');
            }
            $grid->column('id', "ID")->sortable();
            $grid->column('title', '标题')->tree();
            $grid->column('sort', '排序')->editable();
            $grid->column('updated_at', '更新时间')->sortable();

            $grid->quickSearch(['title']);
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Category(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('pid');
            $show->field('sort');
            $show->field('description');
            $show->field('table_text');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $table = request('table', '');
        return Form::make(new Category(), function (Form $form) use($table) {
            if ($form->isEditing()) {
                $table = $form->model()->table_text;
            }
            $form->text('title', '标题')->required();
            $form->image('img', '图标')->uniqueName();
            $form->select('pid', '父类')->options(Category::cateMap(null, request('table', null)))->default(0);
            $form->number('sort', '排序')->default(0);
            $form->textarea('description', '描述');
            $form->hidden('table_text', '所属表')->value(request('table', null));
            $form->saved(function (Form $form) {
                if ($form->model()->table_text) { // 在这里进行判断跳转位置
                    return $form->response()->redirect('category?table='.$form->model()->table_text);
                }
            });
        });
    }
}
