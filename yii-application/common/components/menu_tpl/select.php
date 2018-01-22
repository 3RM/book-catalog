<option
	value="<?= $rubric['id'] ?>"
	<?php if($rubric['id'] == $this->model->parent_id) echo 'selected' ?>
	<?php if($rubric['id'] == $this->model->id) echo 'disabled' ?>
>
	<?= $tab . $rubric['title'] ?>
</option>

<?php if( isset($rubric['childs']) ): ?>
    <ul>
        <?= $this->getMenuHtml($rubric['childs'], $tab . '--')?>
    </ul>
<?php endif;?>