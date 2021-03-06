<?php
/* @var $this PagesController */
/* @var $model StaticPages */

$this->breadcrumbs=array(
	'Static Pages'=>array('index'),
	$model->name=>array('view','id'=>$model->static_page_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StaticPages', 'url'=>array('index')),
	array('label'=>'Create StaticPages', 'url'=>array('create')),
	array('label'=>'View StaticPages', 'url'=>array('view', 'id'=>$model->static_page_id)),
	array('label'=>'Manage StaticPages', 'url'=>array('admin')),
);
?>

<h1>Update StaticPages <?php echo $model->static_page_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>