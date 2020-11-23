<h2><?= $title; ?></h2>

<?php echo validation_errors() ?>

<?php echo form_open('questions/edit'); ?>
<div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" name="email" placeholder="
        Email">
</div>
<div class="form-group">
    <label>Question</label>
    <input type="text" class="form-control" name="question" placeholder="
        question">
</div>
<div class="form-group">
    <label>Answer</label>
    <input type="text" class="form-control" name="anwser" placeholder="
        anwser">
</div>
<div class="form-group">
    <label>Dummy Answer</label>
    <input type="text" class="form-control" name="dummy-anwser" placeholder="
    Dummy Answer">
</div>
<div class="form-group">
    <label>Dummy Answer 2</label>
    <input type="text" class="form-control" name="dummy-anwser2" placeholder="
    Dummy Answer 2">
</div>
<div class="form-group">
    <label>Dummy Answer</label>
    <input type="text" class="form-control" name="dummy-anwser3" placeholder="
    Dummy Answer 3">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close(); ?>
<button type="cancel" class="btn btn-warning" onclick="location.href = href='<?php echo site_url('/questions/browse'); ?>'">Cancel</button>