$(document).ready(function(){
CKEDITOR.replace('menu_recipe',{
    height: '200px',
    toolbar: [
		{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
		[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
		'/',																					// Line break - next group will be placed in new line.
		{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
	]
});
});
var gl_count;
function addField(v,u)
{
var vs=v+u;
gl_count=vs;
var str='<div class="feature" id="'+vs+'">';
str+='<div class="col-sm-6"><div class="form-group"><label>Text </label><input class="form-control" type="text"   placeholder="1 Living Room" name="menu_ingredients[]">';
str+='<button type="button" class="btn btn-xs btn-primary " id="add'+vs+'" onClick="addField('+ vs +','+ vs +')"><i class="fa fa-plus"></i></button>';
str+='<button type="button" class="btn btn-xs btn-danger " onclick="subsField('+ vs +')"><i class="fa fa-minus"></i></button>';
str+='</div></div>';
str+='</div>';	
//alert(str);
$("#add"+v).hide();
$('.addItem').append(str);
//$("#"+v).parent('.addItem').append(str);

/*$('input[type="file"]').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});*/
}



function subsField(v)
{
//alert(v);
if(gl_count==v)
{
var ids=$.trim(gl_count/2);

if($("#add"+ids).length>0)
{
$("#add"+ids).show();
gl_count=ids;	
}
else
{
gl_count=ids;
subsField(ids);
}


}
//var l=$(".addItem .rows").length -1;
//$("#"+v).parent().find('.rows:nth-child('+l+')').find('.btn-add').show();
//alert($("#"+v).parents('.rows').html());
$("#"+v).remove();

}	
function deleteAce(path,table_name,row_id)
{
	if(confirm("Are you sure!")==true)
	{
		$("body").prepend("<div class='alert alert-success' id='alert_category'>Processing....</div>");
		$.post(path,{table_name:table_name,row_id:row_id},function(data){
			if($.trim(data.status)==1)
			{
				$("#ace_row"+row_id).hide();
				$("#alert_category").html(data.message);
				setTimeout(function(){ $(".alert.alert-success").remove(); },1800);
			}
			},'json');
	}
}