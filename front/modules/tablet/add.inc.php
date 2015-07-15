<?php isset($_GET['id']) ? $edit=true : $edit=false; ?>

<h3 class="headline m-top-md">
	<?= $edit ? 'Edit User:' : 'Add a new User: '; ?>
    <div class="float-right margin-bottom-10"><a href="user/search" class="btn btn-primary">Back</a></div>
    <div class="clear"></div>
	<span class="line"></span>
</h3>

<?php
  if($edit):
    $db->where ("id", $_GET['id']);
    $user = $db->getOne ("users");
    if($user['status']==1):
      $checked_enabled = 'checked="checked"';
      $checked_disabled="";
    elseif($user['status']==0):
      $checked_disabled = 'checked="checked"';
      $checked_enabled="";
    endif;

    if($user['backend_login']==1):
      $backend_enabled = 'checked="checked"';
      $backend_disabled="";
    elseif($user['backend_login']==0):
      $backend_disabled = 'checked="checked"';
      $backend_enabled="";
    endif;

  endif;
?>

<form id="formToggleLine" class="form-horizontal no-margin form-border" name="" action="user/submit<?= isset($_GET['id']) ? '/'.$_GET['id'] : '';?>" method="POST">

  <?php if($edit): ?>
    <div class="form-group">
      <label class="col-lg-2 control-label">Status:</label>
      <div class="col-lg-10" style="padding-top: 5px;">
        <label class="label-radio inline" for="enabled">
          <input type="radio" id="enabled" name="status" value="1" <?= $checked_enabled; ?>>
          <span class="custom-radio"></span>
          Enabled
        </label>
        <label class="label-radio inline" for="disabled">
          <input type="radio" id="disabled" name="status" value="0" <?= $checked_disabled; ?>>
          <span class="custom-radio"></span>
          Diabled
        </label>
      </div>
    </div>
  <?php endif; ?>

<?php
    $form->text_field('name', 'Name', $edit ? $user['name'] : '');
    $form->text_field('lastname', 'Last Name', $edit ? $user['lastname'] : '');
    $form->text_field('email', 'Email', $edit ? $user['email'] : '');
    $form->text_field('username', 'Username', $edit ? $user['username'] : '');
?>
   <?php if(!$edit): ?>
    <div class="form-group">
      <label for="password" class="col-lg-2 control-label">Password:</label>
      <div class="col-lg-10">
          <input class="form-control" id="password" name="password" type="password" data-required="true" value="password">
      </div>
    </div>
  <?php endif; ?>

    <div class="form-group">
      <label class="col-lg-2 control-label">Can login to backend? </label>
      <div class="col-lg-10" style="padding-top: 5px;">
        <label class="label-radio inline" for="yes">
          <input type="radio" id="yes" name="backend_login" value="1" <?= !isset($edit) ? $backend_enabled : ''; ?>>
          <span class="custom-radio"></span>
          Yes!
        </label>
        <label class="label-radio inline" for="no">
          <input type="radio" id="no" name="backend_login" value="0" <?= !isset($edit) ? $backend_disabled : ''; ?>>
          <span class="custom-radio"></span>
          No!
        </label>
      </div>
    </div>

     <?= $form->submit_button('Submit'); ?>

</form>

<!-- Script Files -->
<?php include('js/scripts/add.php'); ?>
