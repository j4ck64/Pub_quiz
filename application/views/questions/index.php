<!-- <h2><?php echo $question['slug']; ?></h2>
<h2><?php echo $slug; ?></h2> -->
<h2><?php echo $question['question']; ?></h2>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<ul class="anwsers">

<form>
<!-- <li class="anwser-a" name="anwser-a" value="<?php echo $anwsers['answer']; ?>" onclick="saveAnswer('<?php echo $slug; ?>',<?php echo $anwsers['answer']; ?>)"> -->
<li class="anwser-a" name="anwser-a" value="<?php echo $anwsers['answer']; ?>" onclick="saveAnswer(<?php echo $question['id']; ?>,<?php echo $anwsers['answer']; ?>)">
 
        <?php echo $anwsers['answer']; ?>
    </li>
</form>
   

    <li class="anwser-b" onclick="addanwser(22)"> <?php echo $anwsers['dummy_answer']; ?> </li>
    <li class="anwser-c" onclick="location.href = href='<?php echo site_url('/questions/' . $slug); ?>'"><?php echo $anwsers['dummy_answer2']; ?></li>
    <li class="anwser-d" onclick="location.href = href='<?php echo site_url('/questions/' . $slug); ?>'"><?php echo $anwsers['dummy_answer3']; ?></li>
</ul>