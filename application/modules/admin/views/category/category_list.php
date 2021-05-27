<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
    .fa_btn {
        background: #f74f00;
        color: #ffffff !important;
        padding: 4px 6px !important;
        margin-top: 0px;
        border-radius: 30px;
        margin-left: 0px;
    }
    .margin-20{
        margin-top: 20px;
    }
    .child-class{
        background: red;
        padding: 0px 6px;
        border-radius: 5px;
        color: #fff;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Product Category Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?=base_url('admin');?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i>Product Category Management</li>
        </ol>
    </div>
    <?=$this->session->flashdata('response');?>
    <div class="content">

            <div class="col-md-6">
                <div class="card">
                    <form method="POST" id="categoryForm" enctype="multipart/form-data">
                        <div class="card-body"> 
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Select Category</label>
                                    <select onchange="selectCategory(this,0);" class="form-control" data-title="Category" id="category" name="parent_id[]">
                                        <option value="">Select Categories</option>
                                        <?php if($parent_category_list){ foreach ($parent_category_list as $row) { ?>
                                        <option value="<?= $row['category_id'] ?>"><?php echo $row['name']; ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <div id="childData" class="col-md-12 mt-2"></div>
                                <div class="col-md-12 mt-2">
                                    <label>Category Name</label>
                                    <input type="text" id="english" class="form-control mb-4 regInputs" name="category" placeholder="Category Name" data-title="Category Name">
                                    <p class="errorPrint" id="englishError"></p>
                                    <?= form_error('english') ?>
                                </div>
                                <div class="col-md-12">
                                   <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="saveData(this)">Submit</button>  
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            

            <div class="col-md-12 margin-20">
                <div class="card"> 
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
<script type="text/javascript">
    function saveData(o){
        $(".errorPrint").css('display', 'none');
        var idValidate = false;
        $(".regInputs").each(function (index, value) {
            if ($(this).val()) {
                $("#" + $(this).attr('id') + 'Error').css('display', 'none');
            } else {
                var textData=$(this).parent().find('label').text();
                idValidate = true;
                $("#" + $(this).attr('id') + 'Error').empty();
                $("#" + $(this).attr('id') + 'Error').append('*' + textData + ' is required field');
                $("#" + $(this).attr('id') + 'Error').css('display', 'block');
            }
        });
        if (idValidate) {
            return false;
        } else {
            $("#categoryForm").submit();
        }
    }

    var selectedClass=0;
    function selectCategory(o,id){
        var category=$.trim($(o).val());
        $('.cat_'+category).remove()
        $('.level_'+id).remove()
        console.log('yy',selectedClass,id);
        if(selectedClass<id){
            selectedClass=id;
        }
        console.log(selectedClass,id);
        for(i=id;i<=selectedClass;i++){
            console.log('ss',i)
            $('.level_'+i).remove()
        }
        if(category){
            var reg_form_data = new FormData();
            reg_form_data.append("category_id",category);
            $.ajax({
                url: '<?=$base_url?>subCategoryList',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    var jsonData = jsonData.result;
                    if(jsonData[0]){
                        var newId=id+1;
                        var html='<div class=" cat_'+category+' level_'+id+'"><label>Child Category</label>';
                            html+='<select onchange="selectCategory(this,'+newId+');" class="form-control" data-title="Category" id="category" name="parent_id[]">';
                                html+='<option value="">Select Categories</option>';
                                    jsonData.forEach(function(res,index){
                                        html+='<option value="'+res.category_id+'">'+res.name+'</option>';
                                    })
                        html+='</select></div>';
                        $("#childData").append(html);
                    }
                },
                error: function (error) {
                    alert("error");
                }
            });
        }
    }
</script>  