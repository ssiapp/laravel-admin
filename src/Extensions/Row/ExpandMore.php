<?php
/*
use Encore\Admin\Widgets\Table;
//一对一
$actions->append(new ExpandMore($actions,function (){
    if (empty($this->user_extend)) return '';
    $profile = array_only($this->user_extend->toArray(), ['full_name', 'gender', 'birth', 'address']);
    return new Table([], $profile);
}));

//一对多
$actions->append(new ExpandMore($actions,function (){
    if (empty($this->acca_voucher_details)) return '';
    $rows = [];
    foreach ($this->acca_voucher_details as $key=>$value) {
        $arr['acca_title'] = $value->acca_title->name;
        $arr['summary'] = $value->summary;
        $arr['debit_amount'] = $value->debit_or_credit === 1 ? $value->amount : '';
        $arr['credit_amount'] = $value->debit_or_credit === -1 ? $value->amount : '';
        $rows[] = $arr;
    }
    $table = new Table(['科目','摘要','借','贷'], $rows, ['class'=>'table table-bordered table-hovered']);
    $table->class('table table-bordered table-responsive')->style('margin:20px auto;width:90%;');
    return $table;
}));
 */
namespace Encore\Admin\Extensions\Row;

use Encore\Admin\Admin;

class ExpandMore
{
    protected $objActions;
    protected $callback;

    public function __construct($actions,\Closure $callback = null)
    {
        $this->objActions = $actions;
        $this->callback = $callback;
    }

    protected function script()
    {
        return <<<SCRIPT

$('.grid-expand').on('click', function () {
    if ($(this).data('inserted') == '0') {
        var key = $(this).data('key');
        var row = $(this).closest('tr');
        var html = $('template.grid-expand-'+key).html();

        row.after("<tr><td colspan='"+row.find('td').length+"' style='padding:0 !important; border:0px;'>"+html+"</td></tr>");

        $(this).data('inserted', 1);
    }

    $("i", this).toggleClass("fa-caret-right fa-caret-down");
});

SCRIPT;
    }

    protected function render()
    {
        Admin::script($this->script());

        $callback = $this->callback->bindTo($this->objActions->row);
        $html = call_user_func($callback);
        $key = $this->objActions->getKey();

        return <<<EOT
<a class="btn btn-xs btn-primary grid-expand" data-inserted="0" data-key="{$key}" data-toggle="collapse" data-target="#grid-collapse-{$key}">
    <i class="fa fa-caret-right"></i> 更多
</a>
<template class="grid-expand-{$key}">
    <div id="grid-collapse-{$key}" class="collapse">{$html}</div>
</template>
EOT;
    }

    public function __toString()
    {
        return $this->render();
    }
}