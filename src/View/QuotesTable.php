<?php  # -*- coding: utf-8 -*-

global $wso_widget;

echo $wso_widget->header;
?>


	<table width="100%" cellspacing="0" cellpadding="5">
		<thead>

			<tr>
				<th align="left">Wertpapier</th>
				<th align="right">Kurs</th>
				<th align="right">Perf. %</th>
			</tr>

		</thead>

		<tbody>

		<?php foreach( $wso_widget->quotes as $quotes ): ?>

			<tr instid="<? echo $quotes->instrumentId ?>">
				<td align="left"><? echo $quotes->linkedName ?></td>
				<td align="right"><? echo $quotes->trade ?></td>
				<td align="right"><? echo $quotes->tradePerf1dRel ?></td>
			</tr>

		<?php endforeach; ?>

			<tr>
				<td colspan="3" align="right" style="font-size: 0.8em">
					<a href="http://www.wallstreet-online.de"> provide by
						<img src="<?php echo $wso_widget->assets?>/wallstreetonline.png" style="height:0.8em"/>
					</a>
				</td>
			</tr>

		</tbody>

	</table>




<?php echo $wso_widget->footer;