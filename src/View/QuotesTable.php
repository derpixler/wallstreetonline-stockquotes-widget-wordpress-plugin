<?php  # -*- coding: utf-8 -*-

global $wso_widget;

echo $wso_widget->header;
?>

<ul>

<?php foreach( $wso_widget->quotes as $quotes ): ?>

	<li><?=$quotes->linkedName?> ... <?=$quotes->tradePerf1dRel?></li>

<?php endforeach; ?>

</ul>

<?php echo $wso_widget->footer;