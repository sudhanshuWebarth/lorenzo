<?php
$pdf_Result=$task->queryWhereCustom("lrn_menupdf",array('menu_pdf_name','menu_pdf')," order by id");
if(count($pdf_Result[0])>0)
{
?>
<div class="dropdown inline">
<a class="custom-btn btn red dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  target="_blank" href="#">
Download Full Menu <i class="fa fa-file-pdf-o"></i>  <span class="caret"></span></a>
<ul class="dropdown-menu">
<?php 
foreach($pdf_Result as $list)
{ ?>
	<li><a <?php echo "href=".$call->image_Src(array('lorenzo','restorent','menu_image',$list['menu_pdf'])); ?> target="_blank"><?php echo $list['menu_pdf_name']; ?></a></li>
<?php } ?>
</ul>
</div>
<?php } ?>