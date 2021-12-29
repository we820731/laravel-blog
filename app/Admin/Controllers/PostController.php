<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class PostController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Post(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
//             分類名稱 tag
            $grid->column('is_featured')->using(Post::FEATURED)->label(Post::FEATURED_COLOR);
            $grid->column('status')->using(Post::STATUS)->label(Post::STATUS_COLOR)->sortable();
            $grid->column('created_at');

            $grid->createMode(Grid::CREATE_MODE_DEFAULT);
            $grid->model()->orderBy('id', 'desc');
            $grid->showQuickEditButton(false);
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
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
        return Show::make($id, new Post(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('introduce');
            $show->field('content');
            $show->field('slug');
            $show->field('category_id');
            $show->field('is_featured');
            $show->field('featured_image');
            $show->field('status');
            $show->field('view');
            $show->field('order');
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
        return Form::make(new Post(), function (Form $form) {
            $form->text('title')->required();
            $form->text('slug')->help('文章網址slug')->required();
//            $form->select('category_id')->options(Category::orderBy('id', 'desc')->pluck('name', 'id'))->required();
            $form->textarea('introduce')->required()->saveAsString();
            $form->markdown('content')->languageUrl(admin_asset('@admin/dcat/plugins/editor-md/languages/zh-tw.js'))->required();
//            $form->tags('tag')->pluck('name', 'name')->options(TagModel::OrderBy('id', 'desc')->pluck('name', 'name'))->saving(function ($value) {
//                $name_arr = explode(',', $value);
//
//                return array_map(function ($val) {
//                    $tag = Tag::firstOrCreate(['name' => trim($val)]);
//
//                    return $tag->id;
//                }, $name_arr);
//            })->required();

            $form->select('is_featured')->options(Post::FEATURED)->when(Post::FEATURED_YES, function (Form $form) {
                $form->image('featured_image')->autoUpload()->uniqueName()->default(asset('images/default-post.png'))->saveAsString();
            })->default(0)->required();
            $form->select('status')->options(Post::STATUS)->default('published')->required();
        });
    }
}
