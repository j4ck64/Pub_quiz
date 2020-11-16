<h2><?= $title; ?></h2>

<?php echo validation_errors()?>

<?php echo form_open('users/register'); ?>
<div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" name="email" placeholder="
        Email">
</div>
<div class="form-group">
    <label>Password</label>
    <input type="Password" class="form-control" name="password" placeholder="
        Password">
</div>
<div class="form-group">
    <label>Password</label>
    <input type="Password" class="form-control" name="password2" placeholder="
        Confirm Password">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>