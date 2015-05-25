
<h3 class="headline m-top-md">
    Settings:
    <span class="line"></span>
</h3>

<form id="formToggleLine" class="form-horizontal no-margin form-border"  enctype='multipart/form-data' name="" action="settings/uploadCustomers" method="POST">
  <div class="panel-body">
    <fieldset class="form-horizontal form-border">
      <div class="form-group">
        <label class="control-label col-lg-2">Upload Customers File:</label>
        <div class="col-lg-10">
          <div class="upload-file">
            <input type="file" id="upload-demo" name="customers_file" class="upload-demo">
            <label data-title="Select file" for="upload-demo">
                <span data-title="No file selected..."></span>
            </label>
          </div>
        </div><!-- /.col -->
      </div><!-- /form-group -->

    </fieldset>         
  </div>
  <div class="form-group">
    <label class="col-lg-2 control-label"></label>
    <div class="col-lg-10">
        <button type="submit" class="btn btn-success btn-sm">Upload</button>
    </div>
  </div>

</form>

<!-- Script Files -->
<?php include('js/scripts/add.php'); ?>