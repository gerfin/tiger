<?php

namespace App\Admin\Controllers;

use App\Member;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MemberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Member';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Member());

        $grid->column('id', 'id')->sortable();
        $grid->column('username','用户名');
        $grid->column('phone', '手机号')->display(function() {
            return substr($this->phone, 0, 3).'****'.substr($this->phone, 7);
        });
        $grid->column('avatar', '头像')->image('', 50, 50);
        $grid->column('created_at', '注册时间')->sortable();
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableActions();
        $grid->filter(function ($filter) {

            // 设置created_at字段的范围查询
            $filter->between('created_at', '创建时间')->datetime();
        });

        return $grid;
    }
}
