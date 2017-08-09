<?php

// default max-width: 440px, medium: 340px, small: 290px, tiny: 150px


if ($brand_name != '' && strtolower($add_link) == 'yes') {
	$title = $brand_name . "<br>Savings Calculator";
} else {
	$title = "Savings Calculator";
}

// rather than using exclusively a CSS solution for setting size, PHP is used as well
// so that the text displayed can vary as well
if (strtolower($size) == 'tiny'){
?>

<!-- Copyright 2016 financial-calculators.com -->

<div id="calc-wrap" class="tiny">  <!--default max-width: 440px, medium: 340px, small: 290px, tiny: 150px-->

		<!--calculator-->
		<form id="savings" class="calculator">

			<!--savings calculator-->

			<!-- calculator title -->
			<div class="calc-name"><?php echo ((strtolower($add_link) == 'yes') ? '<a href="https://financial-calculators.com/savings-calculator" target="_blank" data-toggle="tooltip" data-placement="right" title="click for more advanced calculator by financial-calculators.com">' . $title . '</a>' : $title) ?></div>

				<!-- start calculator inputs -->

				<div class="input-group input-group-sm">
					<label class="control-label" for="edCF">Saved Monthly?:</label>
					<input type="text" class="control num" id="edCF" maxlength="14" size="16" value=<?php echo $save_amt ?>>
				</div>


				<div class="input-group input-group-sm">
					<label class="control-label" for="edNumPmts">Number of Months? (#):</label>
					<input type="text" class="control num" id="edNumPmts" maxlength="3" size="16" value=<?php echo $n_months ?>>
				</div>


				<div class="input-group input-group-sm">
					<label class="control-label" for="edRate">Annual Interest Rate?:</label>
					<input type="text" class="control num" id="edRate" maxlength="8" size="16" value=<?php echo $rate ?>>
				</div>


				<hr class="bar" />

				<div class="input-group input-group-sm">
					<label class="control-label">Final Amount (FV):</label>
					<input type="text" class="control num" id="edFV" maxlength="8" size="16" disabled>
				</div>


				<div class="input-group input-group-sm">
					<label class="control-label">Interest Earned:</label>
					<input type="text" class="control num" id="edInterest" maxlength="14" size="16" disabled>
				</div>

				<div class="input-group input-group-sm">
					<label class="control-label">Total Invested:</label>
					<input type="text" class="control num" id="edTotalInvested" maxlength="14" size="16" disabled>
				</div>


				<div class="input-group input-group-sm tail">
					<label class="control-label">Last Deposit:</label>
					<input type="text" class="control num" id="edFVDate" maxlength="14" size="16" disabled>
				</div>


				<!-- end savings calculator -->

		<!--buttons-->

		<!--buttons small-->
		<div class="btn-group">
			<div class="btn-row">
				<div class="btn-wrapper-4"><button type="button" id="btnCalc" class="btn btn-primary btn-calculator" data-toggle="tooltip" data-placement="top" title="calc">C</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnClear" class="btn btn-primary btn-calculator" data-toggle="tooltip" data-placement="top" title="clear">Cl</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnPrint" class="btn btn-primary btn-calculator" data-toggle="tooltip" data-placement="top" title="print">P</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnHelp" class="btn btn-primary btn-calculator" data-toggle="tooltip" data-placement="top" title="help">H</button></div>
			</div>
			<div class="btn-row">
				<div class="btn-wrapper-2"><button type="button" id="btnSchedule" class="btn btn-primary btn-calculator" data-toggle="tooltip" data-placement="bottom" title="schedule">S</button></div>
				<div class="btn-wrapper-2"><button type="button" id="btnCharts" class="btn btn-primary btn-calculator" data-toggle="tooltip" data-placement="bottom" title="charts">Ch</button></div>
			</div>
		</div>

		<div class="foot"><div class="cr">©2016 <?php echo ((strtolower($add_link) == 'yes') ? '<a href="https://financial-calculators.com" target="_blank" data-toggle="tooltip" data-placement="right" title="click for more advanced calculator by financial-calculators.com">financial-calculators.com,<br>all rights reserved</a>' : 'financial-calculators.com,<br>all rights reserved') ?></div><div id="CCY" data-toggle="tooltip" data-placement="right" title="click to change currency or date format">$ : mm/dd/yyyy</div></div>

	</form>
	<!--calculator-->

	<div id="zoomer" <?php echo ((strtolower($hide_resize) === 'yes') ? 'class="hidden"' : "") ?>><span id="shrink" class="flaticon-minussign7"></span><span id="original">&nbsp;&nbsp;Original Size&nbsp;&nbsp;</span><span id="grow" class="flaticon-add73"></span></div>

</div> 
<!--calc-wrap-->

<!--end loan calculator widget-->
<!--end tiny-->


<?php
} elseif(strtolower($size) == "small"){
?>
<!-- Copyright 2016 financial-calculators.com -->

<div id="calc-wrap" class="small">  <!--default max-width: 440px, medium: 340px, small: 290px, tiny: 150px-->

		<!--calculator-->
		<form id="savings" class="calculator">

			<!--savings calculator-->

			<!-- calculator title -->
			<div class="calc-name"><?php echo ((strtolower($add_link) == 'yes') ? '<a href="https://financial-calculators.com/savings-calculator" target="_blank" data-toggle="tooltip" data-placement="right" title="click for more advanced calculator by financial-calculators.com">' . $title . '</a>' : $title) ?></div>

				<!-- start calculator inputs -->

				<div class="input-group input-group-sm">
					<label class="control-label" for="edCF">Monthly Savings?:</label>
					<input type="text" class="control num" id="edCF" maxlength="14" size="16" value=<?php echo $save_amt ?>>
				</div>


				<div class="input-group input-group-sm">
					<label class="control-label" for="edNumPmts">Months? (#):</label>
					<input type="text" class="control num" id="edNumPmts" maxlength="3" size="16" value=<?php echo $n_months ?>>
				</div>


				<div class="input-group input-group-sm">
					<label class="control-label" for="edRate">Interest Rate?:</label>
					<input type="text" class="control num" id="edRate" maxlength="8" size="16" value=<?php echo $rate ?>>
				</div>


				<hr class="bar" />

				<div class="input-group input-group-sm">
					<label class="control-label">Final Amount (FV):</label>
					<input type="text" class="control num" id="edFV" maxlength="8" size="16" disabled>
				</div>


				<div class="input-group input-group-sm">
					<label class="control-label">Interest Earned:</label>
					<input type="text" class="control num" id="edInterest" maxlength="14" size="16" disabled>
				</div>

				<div class="input-group input-group-sm">
					<label class="control-label">Total Invested:</label>
					<input type="text" class="control num" id="edTotalInvested" maxlength="14" size="16" disabled>
				</div>


				<div class="input-group input-group-sm tail">
					<label class="control-label">Last Deposit Date:</label>
					<input type="text" class="control num" id="edFVDate" maxlength="14" size="16" disabled>
				</div>


				<!-- end savings calculator -->



		<!--buttons-->

		<!--buttons small-->
		<div class="btn-group">
			<div class="btn-row">
				<div class="btn-wrapper-4"><button type="button" id="btnCalc" class="btn btn-primary btn-calculator">Calc</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnClear" class="btn btn-primary btn-calculator">Clear</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnPrint" class="btn btn-primary btn-calculator">Print</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnHelp" class="btn btn-primary btn-calculator">Help</button></div>
			</div>
			<div class="btn-row">
				<div class="btn-wrapper-2"><button type="button" id="btnSchedule" class="btn btn-primary btn-calculator">Schedule</button></div>
				<div class="btn-wrapper-2"><button type="button" id="btnCharts" class="btn btn-primary btn-calculator">Charts</button></div>
			</div>
		</div>


		<div class="foot"><div class="cr">©2016 <?php echo ((strtolower($add_link) == 'yes') ? '<a href="https://financial-calculators.com" target="_blank" data-toggle="tooltip" data-placement="right" title="click for more advanced calculator by financial-calculators.com">financial-calculators.com, all rights reserved</a>' : 'financial-calculators.com, all rights reserved') ?></div><div id="CCY" data-toggle="tooltip" data-placement="right" title="click to change currency or date format">$ : mm/dd/yyyy</div></div>

	</form>
	<!--calculator-->

	<div id="zoomer" <?php echo ((strtolower($hide_resize) === 'yes') ? 'class="hidden"' : "") ?>><span id="shrink" class="flaticon-minussign7"></span><span id="original">&nbsp;&nbsp;Original Size&nbsp;&nbsp;</span><span id="grow" class="flaticon-add73"></span></div>

</div> 
<!--calc-wrap-->

<!--end loan calculator widget-->
<!--end small-->


<?php
} elseif(strtolower($size) == "medium"){
?>
<!-- Copyright 2016 financial-calculators.com -->

<div id="calc-wrap" class="medium">  <!--default max-width: 440px, medium: 340px, small: 290px, tiny: 150px-->

		<!--calculator-->
		<form id="savings" class="calculator">

			<!--savings calculator-->

			<!-- calculator title -->
			<div class="calc-name"><?php echo ((strtolower($add_link) == 'yes') ? '<a href="https://financial-calculators.com/savings-calculator" target="_blank" data-toggle="tooltip" data-placement="right" title="click for more advanced calculator by financial-calculators.com">' . $title . '</a>' : $title) ?></div>

				<!-- start calculator inputs -->

				<div class="input-group">
					<label class="control-label" for="edCF">Periodic Savings?:</label>
					<input type="text" class="control num" id="edCF" maxlength="14" size="16" value=<?php echo $save_amt ?>>
				</div>


				<div class="input-group">
					<label class="control-label" for="edNumPmts">Number of Months?:</label>
					<input type="text" class="control num" id="edNumPmts" maxlength="3" size="16" value=<?php echo $n_months ?>>
				</div>


				<div class="input-group">
					<label class="control-label" for="edRate">Annual Interest Rate?:</label>
					<input type="text" class="control num" id="edRate" maxlength="8" size="16" value=<?php echo $rate ?>>
				</div>


				<hr class="bar" />

				<div class="input-group">
					<label class="control-label">Final Amount (fv):</label>
					<input type="text" class="control num" id="edFV" maxlength="8" size="16" disabled>
				</div>


				<div class="input-group">
					<label class="control-label">Interest Earned:</label>
					<input type="text" class="control num" id="edInterest" maxlength="14" size="16" disabled>
				</div>

				<div class="input-group">
					<label class="control-label">Total Amount Invested:</label>
					<input type="text" class="control num" id="edTotalInvested" maxlength="14" size="16" disabled>
				</div>


				<div class="input-group tail">
					<label class="control-label">Last Deposit Date:</label>
					<input type="text" class="control num" id="edFVDate" maxlength="14" size="16" disabled>
				</div>


				<!-- end savings calculator -->


		<!--buttons-->
		<div class="btn-group">
			<div class="btn-row">
				<div class="btn-wrapper-4"><button type="button" id="btnCalc" class="btn btn-primary btn-calculator">Calc</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnClear" class="btn btn-primary btn-calculator">Clear</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnPrint" class="btn btn-primary btn-calculator">Print</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnHelp" class="btn btn-primary btn-calculator">Help</button></div>
			</div>
			<div class="btn-row">
				<div class="btn-wrapper-2"><button type="button" id="btnSchedule" class="btn btn-primary btn-calculator">Schedule</button></div>
				<div class="btn-wrapper-2"><button type="button" id="btnCharts" class="btn btn-primary btn-calculator">Charts</button></div>
			</div>
		</div>


		<div class="foot"><div class="cr">©2016 <?php echo ((strtolower($add_link) == 'yes') ? '<a href="https://financial-calculators.com" target="_blank" data-toggle="tooltip" data-placement="right" title="click for more advanced calculator by financial-calculators.com">financial-calculators.com, all rights reserved</a>' : 'financial-calculators.com, all rights reserved') ?></div><div id="CCY" data-toggle="tooltip" data-placement="right" title="click to change currency or date format">$ : mm/dd/yyyy</div></div>


	</form>
	<!--calculator-->

	<div id="zoomer" <?php echo ((strtolower($hide_resize) === 'yes') ? 'class="hidden"' : "") ?>><span id="shrink" class="flaticon-minussign7"></span><span id="original">&nbsp;&nbsp;Original Size&nbsp;&nbsp;</span><span id="grow" class="flaticon-add73"></span></div>

</div> 
<!--calc-wrap-->

<!--end loan calculator widget-->
<!--end medium-->



<?php
}else{
?>

<!-- default size - large -->
<!-- Copyright 2016 financial-calculators.com -->

<div id="calc-wrap" class="large">  <!--default max-width: 440px, medium: 340px, small: 290px, tiny: 150px-->

		<!--calculator-->
		<form id="savings" class="calculator">

			<!--savings calculator-->

			<!-- calculator title -->
			<div class="calc-name"><?php echo ((strtolower($add_link) == 'yes') ? '<a href="https://financial-calculators.com/savings-calculator" target="_blank" data-toggle="tooltip" data-placement="right" title="click for more advanced calculator by financial-calculators.com">' . $title . '</a>' : $title) ?></div>

				<!-- start calculator inputs -->

				<div class="input-group">
					<label class="control-label" for="edCF">Periodic Savings Amount?:</label>
					<input type="text" class="control num" id="edCF" maxlength="14" size="16" value=<?php echo $save_amt ?>>
				</div>


				<div class="input-group">
					<label class="control-label" for="edNumPmts">Number of Periods to Save?:</label>
					<input type="text" class="control num" id="edNumPmts" maxlength="3" size="16" value=<?php echo $n_months ?>>
				</div>


				<div class="input-group">
					<label class="control-label" for="edRate">Annual Interest Rate?:</label>
					<input type="text" class="control num" id="edRate" maxlength="8" size="16" value=<?php echo $rate ?>>
				</div>


				<hr class="bar" />

				<div class="input-group">
					<label class="control-label">Final Amount (future value):</label>
					<input type="text" class="control num" id="edFV" maxlength="8" size="16" disabled>
				</div>


				<div class="input-group">
					<label class="control-label">Interest Earned:</label>
					<input type="text" class="control num" id="edInterest" maxlength="14" size="16" disabled>
				</div>

				<div class="input-group">
					<label class="control-label">Total Amount Invested:</label>
					<input type="text" class="control num" id="edTotalInvested" maxlength="14" size="16" disabled>
				</div>


				<div class="input-group tail">
					<label class="control-label">Last Deposit Date:</label>
					<input type="text" class="control num" id="edFVDate" maxlength="14" size="16" disabled>
				</div>


				<!-- end savings calculator -->


		<!--buttons-->

		<div class="btn-group">
			<div class="btn-row">
				<div class="btn-wrapper-4"><button type="button" id="btnCalc" class="btn btn-primary btn-calculator">Calc</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnClear" class="btn btn-primary btn-calculator">Clear</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnPrint" class="btn btn-primary btn-calculator">Print</button></div>
				<div class="btn-wrapper-4"><button type="button" id="btnHelp" class="btn btn-primary btn-calculator">Help</button></div>
			</div>
			<div class="btn-row">
				<div class="btn-wrapper-2"><button type="button" id="btnSchedule" class="btn btn-primary btn-calculator">Savings Schedule</button></div>
				<div class="btn-wrapper-2"><button type="button" id="btnCharts" class="btn btn-primary btn-calculator">Charts</button></div>
			</div>
		</div>


		<div class="foot"><div class="cr">©2016 <?php echo ((strtolower($add_link) == 'yes') ? '<a href="https://financial-calculators.com" target="_blank" data-toggle="tooltip" data-placement="right" title="click for more advanced calculator by financial-calculators.com">financial-calculators.com, all rights reserved</a>' : 'financial-calculators.com, all rights reserved') ?></div><div id="CCY" data-toggle="tooltip" data-placement="right" title="click to change currency or date format">$ : mm/dd/yyyy</div></div>

	</form>
	<!--calculator-->

	<div id="zoomer" <?php echo ((strtolower($hide_resize) === 'yes') ? 'class="hidden"' : "") ?>><span id="shrink" class="flaticon-minussign7"></span><span id="original">&nbsp;&nbsp;Original Size&nbsp;&nbsp;</span><span id="grow" class="flaticon-add73"></span></div>

</div> 
<!--calc-wrap-->

<!--end loan calculator widget-->
<!--end default/large-->


<?php
};  // if
?>

<!-- below included with all calculator layouts -->


<!-- HELP TEXT -->
<div class="fc-widget">
	<div id="hShow" class="hidden">
		<div id="hText">
<h2>Savings Calculator — calculate future value</h2>

<p>This calculator easily answers the question &quot;If I save 'X' amount for 'Y' months what will the value be at the end?&quot;</p>
<p>The user enters the &quot;Periodic Savings Amount&quot; (amount saved or invested every month); the &quot;Number of Months&quot; and the &quot;Annual Interest Rate&quot; or the annual rate of return one expects to earn on their investments.</p>
<p>The calculator quickly creates a savings schedule and a set of charts that will help the user see the relationship between the amount invested and the return on the investment. The schedule can be copied and pasted to Excel, if desired.</p>
<p>The investment term is always expressed in months.</p>
<ul class="mono tail"><li>&nbsp;60 months = &nbsp;5 years</li><li>120 months = 10 years</li><li>180 months = 15 years</li><li>240 months = 20 years</li><li class="tail">360 months = 30 years</li></ul>
<p>If you need a more advanced &quot;Savings Calculator&quot; &mdash; one that lets the user solve for the starting amount, the amount to invest, the interest rate, the term required to reach a goal or the future value; or if you would like to easily print the schedule; or if you need to pick a different investment frequency, then you may want to try the calculator located here: <b>https:/financial-calculators.com/savings-calculator</b></p>
		</div>
	</div>
</div>
<!--- end of help text -->




<!-- start dialog code -->
<div id="fc-modals">
<!-- currency date options -->
<div class="modal fade" id="CURRENCYDATE" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-modal">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="bg-modal" aria-hidden="true">&times;</span></button>
				<h4 class="modal-title bg-modal">Currency and Date Conventions</h4>
			</div>
			<div class="modal-body">
					<form>
						<div class="modal-group">
							<div class="radio-group pct50"><label class="radio-label" for="ccyUSD"><input type="radio" name="ccy_grp" id="ccyUSD" class="radio-input">$1,234.56</label></div>
							<div class="radio-group pct50"><label class="radio-label" for="ccyUSD2"><input type="radio" name="ccy_grp" id="ccyUSD2" class="radio-input">$1.234,56</label></div>
							<div class="radio-group pct50"><label class="radio-label" for="ccyGBH"><input type="radio" name="ccy_grp" id="ccyGBH" class="radio-input">£1,234.56</label></div>
							<div class="radio-group pct50"><label class="radio-label" for="ccyNone"><input type="radio" name="ccy_grp" id="ccyNone" class="radio-input">1,234.56</label></div>

							<div class="radio-group pct50"><label class="radio-label" for="ccyEUR1"><input type="radio" name="ccy_grp" id="ccyEUR1" class="radio-input">€1,234.56</label></div>
							<div class="radio-group pct50"><label class="radio-label" for="ccyEUR2"><input type="radio" name="ccy_grp" id="ccyEUR2" class="radio-input">€1.234,56</label></div>
							<div class="radio-group pct50"><label class="radio-label" for="ccyEUR3"><input type="radio" name="ccy_grp" id="ccyEUR3" class="radio-input">1 234,56 €</label></div>
							<div class="radio-group pct50"><label class="radio-label" for="ccyEUR4"><input type="radio" name="ccy_grp" id="ccyEUR4" class="radio-input">1.234,56 €</label></div>
						</div>

						<div class="modal-group">
							<div class="radio-group"><label class="radio-label" for="MMDDYY"><input type="radio" name="date_grp" id="MMDDYY" class="radio-input">mm/dd/yyyy</label></div>
							<div class="radio-group"><label class="radio-label" for="DDMMYY"><input type="radio" name="date_grp" id="DDMMYY" class="radio-input">dd/mm/yyyy</label></div>
							<div class="radio-group"><label class="radio-label" for="YYMMDD"><input type="radio" name="date_grp" id="YYMMDD" class="radio-input">yyyy-mm-dd</label></div>
						</div>

						<div class="modal-text">
							<div>Clicking <b>&quot;Save changes&quot;</b> will cause the calculator to reload. Your edits will be lost.</div>
						</div>
					</form>

			</div>
			<div class="modal-footer">
				<button id="CURRENCYDATE_cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button id="CURRENCYDATE_save" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
			</div>
		</div>
	</div>
</div> 
<!--CURRENCYDATE modal-->

<!-- end currency date options options -->
</div>
<!-- end dialog code -->

<!--end savings calculator plugin-->


