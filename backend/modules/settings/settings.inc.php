	<h3 class="headline m-top-md">
		Add a new pharmacy: 
		<span class="line"></span>
	</h3>

<form id="formToggleLine" class="form-horizontal no-margin form-border">
	<div class="form-group">
		<label class="col-lg-2 control-label">Help Text</label>
		<div class="col-lg-10">
			<input class="form-control" type="text" placeholder="input here...">
			<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	
	<div class="form-group">
		<label class="col-lg-2 control-label">Password</label>
		<div class="col-lg-10">
			<input class="form-control" type="password" placeholder="Password">
		</div><!-- /.col -->
	</div><!-- /form-group -->
	
	<div class="form-group">
		<label class="col-lg-2 control-label">Textarea</label>
		<div class="col-lg-10">
			<textarea class="form-control" rows="3"></textarea>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	
	<div class="form-group">
		<label class="col-lg-2 control-label">Stacked Checkbox</label>
		<div class="col-lg-10">
			<label class="label-checkbox">
				<input type="checkbox">
				<span class="custom-checkbox"></span>
				Option one is this and that be sure to include why it's great
			</label>
			<label class="label-checkbox">
				<input type="checkbox">
				<span class="custom-checkbox"></span>
				Option two can be something else and selecting it will deselect option one		
			</label>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	
	<div class="form-group">
		<label class="col-lg-2 control-label">Inline Checkbox</label>
		<div class="col-lg-10">
			<label class="label-checkbox inline">
				<input type="checkbox">
				<span class="custom-checkbox"></span>
				Checkbox1
			</label>
			<label class="label-checkbox inline">
				<input type="checkbox">
				<span class="custom-checkbox"></span>
				Checkbox2
			</label>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	
	<div class="form-group">
		<label class="col-lg-2 control-label">Stacked Radio Button</label>
		<div class="col-lg-10">
			<label class="label-radio">
				<input type="radio" name="stack-radio">
				<span class="custom-radio"></span>
				Option one is this and that be sure to include why it's great
			</label>
			<label class="label-checkbox">
				<input type="radio" name="stack-radio">
				<span class="custom-radio"></span>
				Option two can be something else and selecting it will deselect option one		
			</label>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	
	<div class="form-group">
		<label class="col-lg-2 control-label">Inline Radio Button</label>
		<div class="col-lg-10">
			<label class="label-radio inline">
				<input type="radio" name="inline-radio">
				<span class="custom-radio"></span>
				Option1
			</label>
			<label class="label-radio inline">
				<input type="radio" name="inline-radio">
				<span class="custom-radio"></span>
				Option2
			</label>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	
	<div class="form-group">
		<label class="col-lg-2 control-label">Select</label>
		<div class="col-lg-10">
			<select class="form-control">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	<div class="form-group">
		<label class="col-lg-2 control-label">Chosen Select</label>
		<div class="col-lg-10">
			<select class="form-control chzn-select">
				<option>Alabama</option>
				<option>Virginia</option>
				<option>Washington</option>
				<option>West Virginia</option>
				<option>Wisconsin</option>
				<option>Wyoming</option>
			</select>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	<div class="form-group">
		<label class="col-lg-2 control-label">Multiple Select</label>
		<div class="col-lg-10">
			<select multiple class="form-control">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	<div class="form-group">
		<label class="col-lg-2 control-label">Chosen Multiple Select</label>
		<div class="col-lg-10">
			<select multiple class="form-control chzn-select">
				<option>Alabama</option>
				<option>Alaska</option>
				<option>West Virginia</option>
				<option>Wisconsin</option>
				<option>Wyoming</option>
			</select>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	
	<div class="form-group">
		<label class="col-lg-2 control-label">Tags</label>
		<div class="col-lg-10">
			<input type="text" class="tag-demo1" value="foo,bar,baz">
			
		</div><!-- /.col -->
	</div><!-- /form-group -->
	<div class="form-group">
		<label class="col-lg-2 control-label">WYSIHTML5</label>
		<div class="col-lg-10">
			<textarea id="wysihtml5-textarea" placeholder="Enter your text ..." class="form-control" rows="6"></textarea>					
		</div><!-- /.col -->
	</div><!-- /form-group -->
	<div class="form-group">
		<label class="col-lg-2 control-label">Date Picker</label>
		<div class="col-lg-10">
			<div class="input-group">
				<input type="text" value="06/10/2013" class="datepicker form-control">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	<div class="form-group">
		<label class="col-lg-2 control-label">Time Picker</label>
		<div class="col-lg-10">
			<div class="input-group bootstrap-timepicker">
				<input class="timepicker form-control" type="text"/>
				<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
			</div>
		</div><!-- /.col -->
	</div><!-- /form-group -->
	
</form>

<!-- Script Files -->
<?php include('js/scripts/add.php'); ?>