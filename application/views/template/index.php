<?php
/**
 * Created by PhpStorm.
 * User: liuwei
 * Date: 2018/6/7
 * Time: 上午11:05
 */
?>
<div class="row">
    <div class="col-md-12">
        <form id="submitForm">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">模板生成功能</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>模块名称(中文)</label>
                                <input type="text" name="controllerName" class="form-control" placeholder="请输入模块名称(中文),例如:管理员模块">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Controller名称(默认小写)</label>
                                <input type="text" name="controller" class="form-control" placeholder="请输入Controller名称(默认小写),例如: Admin">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Model名称(默认小写),例如:Admin_model</label>
                                <input type="text" name="model" class="form-control" placeholder="请输入Model名称(默认小写),例如:Admin_model,例如: Admin">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>view目录(小写),请在 application/views/下自行创建目录,否则无效</label>
                                <input type="text" name="view" class="form-control" placeholder="请输入view目录(小写),例如: admin">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>主表名称</label>
                                <input type="text" name="tbName" class="form-control" placeholder="主表名称,例如: tb_admin">
                            </div>
                        </div>
                    </div><!-- /.row -->
                    <div class="row col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>SQL列表</label>
                                <textarea name="sql" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div><!-- ./box-body -->
                <div class="box-footer">
                    <div class="row col-md-12">
                        <div class="col-md-2 col-md-offset-5">
                            <button id="btn-add" class="btn btn-primary btn-block" type="submit">生成模板</button>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </form>
    </div><!-- /.col -->
</div><!-- /.row -->

<script>
    $(function () {
        var form = $('#submitForm');
        var rules = {
            controllerName: {
                required: true,
                minlength: 2
            },
            controller: {
                required: true,
                minlength: 2
            },
            model: {
                required: true,
                minlength: 2
            },
            view: {
                required: true,
                minlength: 2
            },
            sql: {
                required: true,
                minlength: 2
            },
            tbName: {
                required: true,
                minlength: 2
            }
        };
        Utils.formValidate(form, rules, function () {
            Utils.formAjax(form, {
                url: "<?=site_url('template/generate')?>",
                success: function (data) {
                    Utils.noticeSys(data);
                    if (data.success) {
                        Utils.confirm({
                            title: '温馨提示',
                            text: '你是否要跳转到指定URL:' + data.url,
                            confirm: function() {
                                window.location.href = data.url
                            } 
                        })
                    }
                }
            })
        })
    });
</script>