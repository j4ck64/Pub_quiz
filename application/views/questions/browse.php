<h2><?= $title ?></h2>

<?php foreach ($questions as $question) : ?>
    <div class="browse-question">
    <p><?php echo $question['question']; ?></p>  
    <small class="question-date">Date Published : <?php echo $question['publish_date']; ?></small>

    <button class="btn-edit"  onclick="location.href = href='<?php echo site_url('/questions/edit/'. $question['slug']); ?>'" >Edit</button>
    <!-- <p><a class="btn btn-primary" href="<?php echo site_url('/questions/edit/'. $question['slug']); ?>">Edit</a></p> -->
    <button type="submit" class="btn-delete" onclick="deleteRow(<?php echo $question['id'];?>,'<?php echo $question['slug'];?>')">
    Delete</button>
    </div><br>
<?php endforeach; ?>

<button type="submit" class="btn-create-question" onclick="location.href = href='<?php echo site_url('/questions/create'); ?>'">
    Create Question</button>