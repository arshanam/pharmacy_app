<?php isset($_GET['id']) ? $edit=true : $edit=false; ?>

<h3 class="headline m-top-md">
	<?= $edit ? 'Edit product:' : 'Add a new product: '; ?>
	<span class="line"></span>
</h3>

<?php
  if($edit):
    $db->where ("id", $_GET['id']);
    $product = $db->getOne ("product");
  endif;
?>

<form id="formToggleLine" class="form-horizontal no-margin form-border" name="" action="product/submit<?= isset($_GET['id']) ? '/'.$_GET['id'] : '';?>" method="POST">

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
        $form->text_field('wsale', 'W/Sale', $edit ? $product['wsale'] : '');
        $form->text_field('retail', 'Retail', $edit ? $product['retail'] : '');
        $form->text_field('vat', 'VAT', $edit ? $product['vat'] : '');
        $form->submit_button('Submit');
    ?>
</form>

<!-- Script Files -->
<?php include('js/scripts/add.php'); ?>
