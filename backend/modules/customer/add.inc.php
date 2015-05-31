<?php isset($_GET['id']) ? $edit=true : $edit=false; ?>

<h3 class="headline m-top-md">
	<?= $edit ? 'Edit Customer:' : 'Add a new customer: '; ?>
	<span class="line"></span>
</h3>

<?php
  if($edit):
    $db->where ("id", $_GET['id']);
    $customer = $db->getOne ("customer");
    //print_r($customer);
  endif;
?>

<form id="formToggleLine" class="form-horizontal no-margin form-border" name="" action="customer/submit<?= isset($_GET['id']) ? '/'.$_GET['id'] : '';?>" method="POST">

    <div class="form-group">
        <label for="card_code" class="col-lg-2 control-label">Card Code:</label>
        <div class="col-lg-10">
            <input class="form-control" id="card_code" name="card_code" type="text" <?= $edit ? 'value="'.$customer['card_code'].'"' : 'value=""' ?>>
        </div>
    </div>


    <div class="form-group">
		    <label for="card_name" class="col-lg-2 control-label">Card Name:</label>
        <div class="col-lg-10">
            <input class="form-control" id="card_name" name="card_name" type="text" <?= $edit ? 'value="'.$customer['card_name'].'"' : 'value=""' ?>>
        </div>
	  </div>

    <div class="form-group">
        <label for="group_code" class="col-lg-2 control-label">Group:</label>
        <div class="col-lg-6">
          <select id="group_code" name="group_code" class="form-control">
            <option value="">Please Select a group: </option>
            <?php
                $groups = $db->get("groups");
                foreach($groups as $group):
                  $group['group_code']==$customer['group_code'] ? $selected='selected' : $selected='';
                  echo'<option value="'.$group['group_code'].'" '.$selected.'>'.$group['group_name'].'</option>';
                endforeach ?>
          </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="region">Region:</label>
        <div class="col-lg-6">
            <select id="region" name="region" class="form-control">
                <option value="">Please Select region: </option>
                <?php
                    $regions = $db->get("region");
                    foreach($regions as $reg):
                      $reg['id']==$customer['region'] ? $region_selected='selected' : $region_selected='';
                      echo'<option value="'.$reg['id'].'" '.$region_selected.'>'.$reg['title'].'</option>';
                    endforeach ?>
            </select>
        </div>
        <div class="col-lg-5"></div>
    </div><!-- /form-group -->

    <div class="form-group">
        <label for="address" class="col-lg-2 control-label">Address:</label>
        <div class="col-lg-10">
            <textarea class="form-control" name="address" id="address" rows="3"><?= $edit ? $customer['address'] : '' ?></textarea>
        </div><!-- /.col -->
    </div><!-- /form-group -->

    <div class="form-group">
        <label for="zip_code" class="col-lg-2 control-label">Zip Code:</label>
        <div class="col-lg-10">
            <input class="form-control" id="zip_code" name="zip_code" type="text" <?= $edit ? 'value="'.$customer['zip_code'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="city" class="col-lg-2 control-label">City:</label>
        <div class="col-lg-10">
            <input class="form-control" id="city" name="city" type="text" <?= $edit ? 'value="'.$customer['city'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="mail_address" class="col-lg-2 control-label">Mail Address:</label>
        <div class="col-lg-10">
            <input class="form-control" id="mail_address" name="mail_address" type="text" <?= $edit ? 'value="'.$customer['mail_address'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="mail_zip_code" class="col-lg-2 control-label">Mail Zip Code:</label>
        <div class="col-lg-10">
            <input class="form-control" id="mail_zip_code" name="mail_zip_code" type="text" <?= $edit ? 'value="'.$customer['mail_zip_code'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="phone1" class="col-lg-2 control-label">Phone 1:</label>
        <div class="col-lg-10">
            <input class="form-control" id="phone1" name="phone1" type="text" <?= $edit ? 'value="'.$customer['phone1'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="phone2" class="col-lg-2 control-label">Phone 2:</label>
        <div class="col-lg-10">
            <input class="form-control" id="phone2" name="phone2" type="text" <?= $edit ? 'value="'.$customer['phone2'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="cellular" class="col-lg-2 control-label">Cellular:</label>
        <div class="col-lg-10">
            <input class="form-control" id="cellular" name="cellular" type="text" <?= $edit ? 'value="'.$customer['cellular'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="fax" class="col-lg-2 control-label">Fax:</label>
        <div class="col-lg-10">
            <input class="form-control" id="fax" name="fax" type="text" <?= $edit ? 'value="'.$customer['fax'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="contact_person" class="col-lg-2 control-label">Contact Person:</label>
        <div class="col-lg-10">
            <input class="form-control" id="contact_person" name="contact_person" type="text" <?= $edit ? 'value="'.$customer['contact_person'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="country" class="col-lg-2 control-label">Country:</label>
        <div class="col-lg-10">
            <input class="form-control" id="country" name="country" type="text" <?= $edit ? 'value="'.$customer['country'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="country_code" class="col-lg-2 control-label">Country Code:</label>
        <div class="col-lg-10">
            <input class="form-control" id="country_code" name="country_code" type="text" <?= $edit ? 'value="'.$customer['country_code'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-lg-2 control-label">Email:</label>
        <div class="col-lg-10">
            <input class="form-control" id="email" name="email" type="text" <?= $edit ? 'value="'.$customer['email'].'"' : 'value=""' ?>>
        </div>
    </div>

    <div class="form-group">
        <label for="block" class="col-lg-2 control-label">Block:</label>
        <div class="col-lg-10">
          <textarea class="form-control" name="block" id="block" rows="3"><?= $edit ? $customer['block'] : '' ?></textarea>
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
