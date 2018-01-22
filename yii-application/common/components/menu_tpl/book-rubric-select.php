<option
	value="<?= $rubric['id'] ?>"
	<?php if($rubric['id'] == $this->selectedRubric) echo 'selected' ?>
>
	<?= $tab . $rubric['title'] ?>
</option>

<?php if( isset($rubric['childs']) ): ?>
    <ul>
        <?= $this->getMenuHtml($rubric['childs'], $tab . '--')?>
    </ul>
<?php endif;?>