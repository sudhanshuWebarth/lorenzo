<?php 
$Category_1=new callFiles();
$Category_2=new operations();
 ?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>
<div class="widget-box">
<div class="widget-header widget-header-flat">
<h4 class="widget-title smaller blue"> Menu List  </h4>
</div>
<button type="button" onclick="location.assign('<?php echo $Category_1->file_Url(array('lorenzo','restorent','export_email')); ?>')" class="btn btn-primary"><i class="fa fa-external-link"></i> Export</button>
<div id="userBody">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-data table-blue display" id="datatable">
    <thead>
        <tr>
            <th>SNo.</th>
            <th>User Eamil</th>
            <th>Subscription Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
	if($Category_2->getCount("select id from lrn_newsletter")>0)
	{
	$user_List=$Category_2->queryWhereCustom("lrn_newsletter",array('id','con_email','con_date')," order by id desc");
	$sn=1;
	foreach($user_List as $list)
	{
	?>
        <tr id="ace_row<?php echo $list['id'];?>">
        	<td><?php echo $sn; ?></td>
           <td><?php echo $list['con_email'];?></td>
             <td><?php echo date("F m, Y  g:i A",strtotime($list['con_date']));?></td>
            <td>
<div class="btn-group btn-group-xs" style="width:auto; margin-left:auto; margin-right:auto; display:table;">
<div class="clearfix"></div>
<button type="button" onclick="deleteAce('<?php echo $Category_1->file_Url(array('lorenzo','restorent','process_delete')); ?>','lrn_newsletter','<?php echo $list['id'];?>')" class="btn btn-danger"><i class="fa fa-trash-o"></i> Del</button>
<div class="clearfix"></div>
</div>
</td>
</tr>  
        <?php $sn++; } }?>   
    </tbody>
</table>
</div>
</div>