
<style>
    .child-class{
        background: red;
        padding: 0px 6px;
        border-radius: 5px;
        color: #fff;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Dashboard</h1>
    </div>

    <div class="content">
        
        <div class="mt-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Category List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-image">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Category Name</th>
                                    <th>Parent Category</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sr=1; if ($category_list): foreach ($category_list as $list): ?>
                                        <tr>
                                            <td><?=$sr;?></td>
                                            <td><?= $list['name']; ?></td>
                                            <td>
                                                <?php if($list['childList']): foreach($list['childList'] as $child): ?>
                                                    <span class="child-class"> <?=$child['name']; ?></span>
                                                <?php endforeach; endif; ?>
                                            </td>
                                            <td><?=($list['category_parent_id']==0)?"Parent":"Childern"; ?></td>
                                            <td>
                                            <a style="cursor:pointer;" onclick="deleleCategory(this, <?= $list['category_id'] ?>);" class="composemail"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    $sr++;
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    function deleleCategory(obj, id) {
        var r = confirm("Are you sure to delete!");
        if (r == true) {
            if (id) {
                var reg_form_data = new FormData();
                reg_form_data.append("category_id",id);
                $.ajax({
                    url: '<?=$base_url?>deleteCategory',
                    type: "POST",
                    data: reg_form_data,
                    enctype: 'multipart/form-data',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        var dta = $.trim(data);
                        var jsonData = $.parseJSON(dta);
                        if(jsonData.error_code==200){
                            alert(jsonData.message);
                            location.reload();
                        }else{
                            alert(jsonData.message)
                        }
                    },
                    error: function (error) {
                        alert("error");
                    }
                });
            } else {
                alert("Something Wrong");
                location.reload();
            }
        }
    }
</script>