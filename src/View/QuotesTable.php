<?php  # -*- coding: utf-8 -*-

global $wso_quotes;

echo $wso_quotes[0]['before_widget'];
echo $wso_quotes[0]['before_title'] . $wso_quotes[1]['title'] . $wso_quotes[0]['after_title'];
?>

<ul>

<?php foreach( $wso_quotes[0]['data']->data as $quotes ): ?>

	<li><?=$quotes->linkedName?> ... <?=$quotes->tradePerf1dRel?></li>

<?php endforeach; ?>

</ul>

<?php echo $wso_quotes[0]['after_widget'];