
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
        <label class="col-lg-2 control-label"></label>
        <div class="col-lg-10">
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
        </div>
    </div>

</form>

<!-- Script Files -->
<?php include('js/scripts/add.php'); ?>