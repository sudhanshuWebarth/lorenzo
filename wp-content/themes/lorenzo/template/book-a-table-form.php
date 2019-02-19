<form class="book-table tablebook">

<div class="col-sm-6">
<div class="form-group">
<input type="text" class="form-control" placeholder="Name" name="con_fname" required="required">
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<input type="text" class="form-control" placeholder="Last Name" name="con_lname" required="required">
</div>
</div>
<div class="clearfix"></div>


<div class="col-sm-6">
<div class="form-group">
<input type="email" class="form-control" placeholder="Email" name="con_email" required="required">
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<input type="text" class="form-control" placeholder="Contact number" maxlength="14" minlength="10" name="con_phone">
</div>
</div>
<div class="clearfix"></div>


<div class="col-sm-6">
<div class="form-group">
<input type="text" class="form-control date-control con_date" placeholder="mm/dd/yyyy" name="con_date">
</div>
</div>


<div class="col-sm-6">
<div class="form-group">
<input type="number" class="form-control" placeholder="Number Of Guest" min="1" max="100" name="con_guest" required="required">
</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
<input type="hidden" name="con_subject" value="Lorenzo Book Table" />
<input type="hidden" name="con_toemail" value="<?php echo TO_EMAIL; ?>" />
<button type="submit" class="btn codeTable_btn">Book A Table</button>

</div>

<div class="clearfix"></div>

</form>