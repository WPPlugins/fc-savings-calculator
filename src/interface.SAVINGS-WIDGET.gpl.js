
/*global alert: false, jQuery: false, GUI$: false */

/*jslint vars: true */

/** 
* @preserve Copyright 2016 Pine Grove Software, LLC
* financial-calculators.com
* pine-grove.com
* interface.SAVINGS.js
*/
(function ($, GUI) {
	'use strict';

	// don't try to initialize the wrong calculator
	if (!document.getElementById('savings')) {
		return;
	}


	var obj = {}, // interface object to base equations
		// schedule,
		// gui controls
		cfInput,
		numPmtsInput,
		rateInput;



	/**
	* init() -- init or reset GUI's values
	*/
	function initGUI() {
		var dt = new Date();
		dt.setHours(0, 0, 0, 0);

		cfInput.setValue(cfInput.getUSNumber());
		numPmtsInput.setValue(numPmtsInput.getUSNumber());
		rateInput.setValue(rateInput.getUSNumber());

		document.getElementById("edFV").value = GUI.formatLocalFloat(0.0, GUI.moneyConventions, 2);
		document.getElementById("edInterest").value = GUI.formatLocalFloat(0.0, GUI.moneyConventions, 2);
		document.getElementById("edTotalInvested").value = GUI.formatLocalFloat(0.0, GUI.moneyConventions, 2);
		document.getElementById("edFVDate").value = GUI.dateConventions.date_mask;

	} // initGUI



	/**
	* clearGUI() -- reset GUI's values
	*/
	function clearGUI() {

		cfInput.setValue(0.0);
		numPmtsInput.setValue(0);
		rateInput.setValue(0.0);

		document.getElementById("edFV").value = GUI.formatLocalFloat(0.0, GUI.moneyConventions, 2);
		document.getElementById("edInterest").value = GUI.formatLocalFloat(0.0, GUI.moneyConventions, 2);
		document.getElementById("edTotalInvested").value = GUI.formatLocalFloat(0.0, GUI.moneyConventions, 2);
		document.getElementById("edFVDate").value = GUI.dateConventions.date_mask;

	} // clearGUI



	/**
	* getInputs() -- get user inputs and initialize obj equation interface object
	*/
	function getInputs() {
		// var temp, selPmtFreq, selCmpFreq, date1, date2;

		// all rates are passed as decimal equivalents
		obj = {};
		obj.pv = cfInput.getUSNumber();
		obj.cf = obj.pv;
		obj.n = numPmtsInput.getUSNumber();
		obj.nominalRate = rateInput.getUSNumber() / 100;
		obj.fv = 0.0;


		obj.oDate = GUI.dateMath.getFirstNextMonth(new Date());
		obj.oDate.setHours(0, 0, 0, 0);
		obj.fDate = GUI.dateMath.getFirstNextMonth(new Date(obj.oDate));
		obj.lDate = new Date();

		obj.pmtFreq = 6;
		obj.cmpFreq = 6;
		obj.pmtMthd = 1;

	} 



	/** 
	* calc() -- initialize CashInputs data structures for equation classes
	*/
	function calc() {
		var invested;

		if (obj.cf === 0 || obj.nominalRate === 0 || obj.n === 0) {
			alert('There are unknown values.\nPlease make sure all values are entered.');
			return null;
		}

		obj.lDate.setTime(GUI.dateMath.addPeriods(obj.oDate, obj.n, obj.pmtFreq));
		GUI.SAVINGS_SCHEDULE.calc(obj);
		obj.fv = GUI.summary.unadjustedBalance;
		invested = obj.cf * obj.n;
		obj.lDate.setTime(GUI.dateMath.addPeriods(obj.oDate, obj.n - 1, obj.pmtFreq));

		document.getElementById("edFV").value = GUI.formatLocalFloat(GUI.roundMoney(obj.fv, 2), GUI.moneyConventions, 2);
		document.getElementById("edInterest").value = GUI.formatLocalFloat(GUI.roundMoney(obj.fv - invested, 2), GUI.moneyConventions, 2);
		document.getElementById("edTotalInvested").value = GUI.formatLocalFloat(GUI.roundMoney(invested, 2), GUI.moneyConventions, 2);
		document.getElementById('edFVDate').value = GUI.dateMath.dateToDateStr(obj.lDate, GUI.dateConventions);
		return 1;
	} // function calc()




	$(document).ready(function () {

		//
		// initialize GUI controls & dialog / modal controls here
		// attach
		//


		// main window
		cfInput = new GUI.NE('edCF', GUI.moneyConventions, 2);
		numPmtsInput = new GUI.NE('edNumPmts', GUI.numConventions, 0);
		rateInput = new GUI.NE('edRate', GUI.rateConventions, 4);

		initGUI();


		$('#btnCalc').click(function () {
			if (getInputs() !== null) {
				// schedule = null;
				obj.fv = 0.0;
				calc();
			}
		});


		$('#btnClear').click(function () {
			clearGUI();
		});


		$('#btnPrint').click(function () {
			getInputs();
			obj.fv = 0.0;
			if (calc() !== null) {
				GUI.print_calc();
			}
		});


		$('#btnSchedule').click(function () {
			getInputs();
			obj.fv = 0.0;
			if (calc() !== null) {
				GUI.showSavingsSchedule(GUI.SAVINGS_SCHEDULE.calc(obj));
			}
		});


		$('#btnCharts').click(function () {
			GUI.summary.cashFlowType = 1;
			getInputs();
			if (calc() !== null) {
				GUI.showSavingsCharts(GUI.SAVINGS_SCHEDULE.calc(obj));
			}
		});


		$('#btnHelp').click(function () {
			GUI.show_help();
		});


		$('#btnCcyDate, #btnCcyDate2, #CCY').click(function () {
			GUI$.init_CURRENCYDATE_Dlg();
		});

	}); // $(document).ready

}(jQuery, GUI$));
