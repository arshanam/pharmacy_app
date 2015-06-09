<?php isset($_GET['id']) ? $edit=true : $edit=false; ?>

<h3 class="headline m-top-md">
	<?= $edit ? 'Edit Customer:' : 'Add a new customer: '; ?>
	<span class="line"></span>
</h3>

<?php
  if($edit):
    $db->where ("id", $_GET['id']);
    $customer = $db->getOne ("customer");
  endif;
?>

<form id="formToggleLine" class="form-horizontal no-margin form-border" name="" action="customer/submit<?= isset($_GET['id']) ? '/'.$_GET['id'] : '';?>" method="POST">

<?php
    $form->text_field('card_code', 'Card Code', $edit ? $customer['card_code'] : '');
    $form->text_field('card_name', 'Card Name', $edit ? $customer['card_name'] : '');
    $form->text_field('address', 'Address', $edit ? $customer['address'] : '');
    $form->text_field('zip_code', 'Zip Code', $edit ? $customer['zip_code'] : '');
?>

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

    
    <?php
        $form->text_field('city', 'City', $edit ? $customer['city'] : '');
        $form->text_field('mail_address', 'Mail Address', $edit ? $customer['mail_address'] : '');
        $form->text_field('mail_zip_code', 'Mail Zip Code', $edit ? $customer['mail_zip_code'] : '');
        $form->text_field('phone1', 'Phone', $edit ? $customer['phone1'] : '');
        $form->text_field('phone2', 'Phone 2', $edit ? $customer['phone2'] : '');
        $form->text_field('cellular', 'Cellular', $edit ? $customer['cellular'] : '');
        $form->text_field('fax', 'Fax', $edit ? $customer['fax'] : '');
        $form->text_field('contact_person', 'Contact Person', $edit ? $customer['contact_person'] : '');
        $form->text_field('country', 'Country', $edit ? $customer['country'] : '');
        $form->text_field('country_code', 'Country Code', $edit ? $customer['country_code'] : '');
        $form->text_field('email', 'Email', $edit ? $customer['email'] : '');
        $form->text_field('block', 'Block', $edit ? $customer['block'] : '');

        $form->submit_button('Submit');
    ?>
</form>

<!-- Script Files -->
<?php include('js/scripts/add.php'); ?>
