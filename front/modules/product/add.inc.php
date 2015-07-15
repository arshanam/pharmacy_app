<?php isset($_GET['id']) ? $edit=true : $edit=false; ?>

<h3 class="headline m-top-md">
	<?= $edit ? 'Edit product:' : 'Add a new product: '; ?>
    <div class="float-right margin-bottom-10"><a href="product/search" class="btn btn-primary">Back</a></div>
    <div class="clear"></div>
	<span class="line"></span>
</h3>

<?php
  if($edit):
    $db->where ("id", $_GET['id']);
    $product = $db->getOne ("product");
    if($product['status']==1):
      $checked_enabled = 'checked="checked"';
      $checked_disabled="";
    elseif($product['status']==0):
      $checked_disabled = 'checked="checked"';
      $checked_enabled="";
    endif;

  endif;
?>

<form id="formToggleLine" class="form-horizontal no-margin form-border" name="" action="product/submit<?= isset($_GET['id']) ? '/'.$_GET['id'] : '';?>" method="POST">

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
    $form->text_field('item_code', 'Item Code', $edit ? $product['item_code'] : '');
    $form->text_field('barcode', 'Barcode', $edit ? $product['barcode'] : '');
?>

    <div class="form-group">
        <label for="supplier" class="col-lg-2 control-label">Supplier:</label>
        <div class="col-lg-6">
          <select id="supplier" name="supplier" class="form-control">
            <option value="">Please select supplier: </option>
            <?php
                $suppliers = $db->get("product_supplier");
                foreach($suppliers as $supplier):
                  $supplier['id']==$product['supplier'] ? $selected='selected' : $selected='';
                  echo'<option value="'.$supplier['id'].'" '.$selected.'>'.$supplier['title'].'</option>';
                endforeach ?>
          </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="category">Category:</label>
        <div class="col-lg-6">
            <select id="category" name="category" class="form-control">
                <option value="">Please select category: </option>
                <?php
                    $categories = $db->get("product_category");
                    foreach($categories as $cat):
                      $cat['id']==$product['category'] ? $cat_selected='selected' : $cat_selected='';
                      echo'<option value="'.$cat['id'].'" '.$cat_selected.'>'.$cat['title'].'</option>';
                    endforeach ?>
            </select>
        </div>
        <div class="col-lg-5"></div>
    </div><!-- /form-group -->

    
    <?php
        $form->text_area('description', 'Description', $edit ? $product['description'] : '');
        $form->text_field('wsale', 'W/Sale', $edit ? $product['wsale'] : '');
        $form->text_field('retail', 'Retail', $edit ? $product['retail'] : '');
        $form->text_field('vat', 'VAT', $edit ? $product['vat'] : '');
        $form->submit_button('Submit');
    ?>
</form>

<!-- Script Files -->
<?php include('js/scripts/add.php'); ?>
