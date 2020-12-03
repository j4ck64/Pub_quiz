<table class="results">
    <thead>
        <tr>
            <th>Question</th>
            <th>Your Anwser</th>
            <th>Correct Anwser</th>
            <th>Result</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions as $question) : ?>
            <tr>
                <td><?php echo $question->question ?></td>
                <td><?php echo $question->user_anwser ?></td>
                <td><?php echo $question->anwser ?></td>
                <td><?php echo $question->is_correct?></td>
               
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>