<?php

namespace Encore\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class NEditor extends Field
{
    public static $js = [
        '/vendor/laravel-admin/neditor/basic.config.js',
        '/vendor/laravel-admin/neditor/neditor.all.min.js',
        '/vendor/laravel-admin/neditor/i18n/zh-cn/zh-cn.js',
    ];

    protected $view = 'admin::form.neditor';

    public function render()
    {
        $this->script = <<<EOT
        UE.delEditor("ssi_ueditor_{$this->id}");
        var ue = UE.getEditor('ssi_ueditor_{$this->id}',{
            initialFrameHeight:360,//设置编辑器高度
        }); 
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });

EOT;
        return parent::render();
    }
}