
<h3 class="headline m-top-md">
	Add a new pharmacy: 
	<span class="line"></span>
</h3>

<form id="formToggleLine" class="form-horizontal no-margin form-border" name="" action="pharmacy/submit" method="POST">

	<div class="form-group">
		<label for="name" class="col-lg-2 control-label">Name:</label>
		<div class="col-lg-10">
			<input class="form-control" id="name" name="name" type="text">
		</div>
	</div>
	
	<div class="form-group">
		<label for="last_name" class="col-lg-2 control-label">Last Name:</label>
		<div class="col-lg-10">
			<input class="form-control" id="last_name" name="last_name" type="text">
		</div>
	</div>

	<div class="form-group">
		<label for="title" class="col-lg-2 control-label">Title:</label>
		<div class="col-lg-10">
			<input class="form-control" id="title" name="title" type="text">
		</div>
	</div>

	<div class="form-group">
		<label for="address" class="col-lg-2 control-label">Address:</label>
		<div class="col-lg-10">
			<textarea class="form-control" name="address" id="address" rows="3"></textarea>
		</div><!-- /.col -->
	</div><!-- /form-group -->

		<div class="form-group">
		<label class="control-label col-lg-3">Required</label>
		<div class="col-lg-9">
			<input type="text" class="form-control input-sm" data-required="true" placeholder="Required Field">
			<div class="seperator"></div>
		</div><!-- /.col -->
	</div><!-- /form-group -->


	
	<div class="form-group">
		<label class="col-lg-2 control-label" for="city">City:</label>
		<div class="col-lg-5">
			<select id="city" name="city" class="form-control">
				<option value="">Please Select a city: </option>
				<?php
					$cities = $db->select("city");
					foreach($cities as $city):
						echo'<option value="'.$city['id'].'">'.$city['city'].'</option>';
				?>
					<?php endforeach ?>
			</select>
		</div>
		<div class="col-lg-5"></div>
	</div><!-- /form-group -->

	<div class="form-group">
		<label for="phone_number" class="col-lg-2 control-label">Phone Number:</label>
		<div class="col-lg-10">
			<input class="form-control" id="phone_number" name="phone_number" type="text">
		</div>
	</div>

	<div class="form-group">
		<label for="alternative_phone_number" class="col-lg-2 control-label">Alternative Phone Number:</label>
		<div class="col-lg-10">
			<input class="form-control" id="alternative_phone_number" name="alternative_phone_number" type="text">
		</div>
	</div>





	<div class="form-group">
		<label class="col-lg-2 control-label"></label>
		<div class="col-lg-10">
			<button type="submit" class="btn btn-success btn-sm">Submit</button>
		</div>
	</div>

</form>

<!-- Script Files -->
<?php include('js/scripts/add.php'); ?>