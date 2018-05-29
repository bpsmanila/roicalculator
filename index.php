<!DOCTYPE html>
<html>
<head>
<title>ROI Calculator</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="style.css" />
</head>

<body>

<div ng-app="myApp" ng-controller="myCtrl">

<h3>Current Situation Questions</h3>
<form>
<p>Cost Per Acquisition ($) <input type="number" ng-model="cpa"/></p>
<p>Monthly Sales <input type="number" ng-model="monthlysales"/></p>
<p>Average Order Value (AOV) ($) <input type="number" ng-model="aveordervalue"/></p>
<p>Monthly Ad Spend ($) <input type="number" ng-model="monthlyadspend"/></p>
<p>Estimated Current ROA (%) <span class="currentroa percentage">{{newroa() | percentage:2}}%</span><input type="number" ng-model="currentroa" bound-model="newroa()" disabled /></p>
<p>Estimated Current Spend <span class="estimatedcurrentspend currency">{{estimatednewspend() | currency}}</span><input type="number" ng-model="estimatedcurrentspend" bound-model="estimatednewspend()" disabled /></p>
<p>Estimated Current Gross <span class="estimatedcurrentgross currency">{{estimatednewgross() | currency}}</span><input type="number" ng-model="estimatedcurrentgross" bound-model="estimatednewgross()" disabled /></p>
</form>
<h3>Options</h3>
<div class="table-responsive">
<table class="options">
<tr><th>#</th><th>Mod</th><th>Needed</th><th>Best</th><th>Expected</th><th>Worst</th><th>Time Frame <br/>(BEST)</th><th>Time Frame <br/>(EXPECTED)</th><th>Time Frame <br/>(WORST)</th><th>Metric</th></tr>
  <tr ng-repeat="x in options">
  <td>{{$index + 1}}</td><td>{{x.mod}}</td><td><select ng-model="x.needed" ng-options="entry.k as entry.l for entry in [{k:0, l:'N'}, {k:1,l:'Y'}]">
    </select></td><td><input type="number" ng-model="x.best" step="0.01"/></td><td><input type="number" ng-model="x.expected" step="0.01"/></td><td><input type="number" ng-model="x.worst" step="0.01"/></td><td><input type="number" ng-model="x.timeframeb" min="3" max="24" /></td><td><input type="number" ng-model="x.timeframee" min="3" max="24" /></td><td><input type="number" ng-model="x.timeframew" min="3" max="24" /></td><td>{{x.metric}}</td></tr>
</table>
</div>
<input type="button" id="btnreset" ng-click="reset()" value="Reset Options" /><input type="button" id="btnsubmit" ng-click="update()" value="Update Options" />

<div class="hide">
<p>{{newoptions | json}}</p>
<p>{{newoptionssalesyes | json}}</p>
<p>{{newoptionssalesall | json}}</p>
<p>{{newoptionscpayes | json}}</p>
<p>{{newoptionscpaall | json}}</p>
</div>
<h3>Sales Data (Yes Only)</h3>
<div class="table-responsive">
<table class="optionssalesonly">
<tr><th>#</th><th>Mod</th><th>Needed</th><th>Best</th><th>Expected</th><th>Worst</th><th>Time Frame <br/>(BEST)</th><th>Time Frame <br/>(EXPECTED)</th><th>Time Frame <br/>(WORST)</th><th>Metric</th></tr>
  <tr ng-repeat="x in newoptionssalesyes">
  <td>{{$index + 1}}</td><td>{{x.mod}}</td><td><select disabled ng-model="x.needed" ng-options="entry.k as entry.l for entry in [{k:0, l:'N'}, {k:1,l:'Y'}]">
    </select></td><td><input disabled type="number" ng-model="x.best" step="0.01"/></td><td><input disabled type="number" ng-model="x.expected" step="0.01"/></td><td><input disabled type="number" ng-model="x.worst" step="0.01"/></td><td><input disabled type="number" ng-model="x.timeframeb" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframee" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframew" min="3" max="24" /></td><td>{{x.metric}}</td></tr>
	<tr><td colspan="3">TOTALS</td><td ng-model="SalesYesTotalBest">{{getSalesYesTotalBest()}}</td><td ng-model="SalesYesTotalExpected">{{getSalesYesTotalExpected()}}</td><td ng-model="SalesYesTotalWorst">{{getSalesYesTotalWorst()}}</td><td ng-model="SalesYesTotalTFBest">{{getSalesYesTotalTFBest()}}</td><td ng-model="SalesYesTotalTFExpected">{{getSalesYesTotalTFExpected()}}</td><td ng-model="SalesYesTotalTFWorst">{{getSalesYesTotalTFWorst()}}</td><td></td></tr>
	<tr class="hide"><td colspan="3">Factor</td><td ng-model="SalesYesTotalBestFactor">{{getSalesYesTotalBestFactor()}}</td><td ng-model="SalesYesTotalExpectedFactor">{{getSalesYesTotalExpectedFactor()}}</td><td ng-model="SalesYesTotalWorstFactor">{{getSalesYesTotalWorstFactor()}}</td><td></td><td></td><td></td><td></td></tr>
</table>
</div>

<h3>Sales Data (ALL)</h3>
<div class="table-responsive">
<table class="optionssalesall">
<tr><th>#</th><th>Mod</th><th>Needed</th><th>Best</th><th>Expected</th><th>Worst</th><th>Time Frame <br/>(BEST)</th><th>Time Frame <br/>(EXPECTED)</th><th>Time Frame <br/>(WORST)</th><th>Metric</th></tr>
  <tr ng-repeat="x in newoptionssalesall">
  <td>{{$index + 1}}</td><td>{{x.mod}}</td><td><select disabled ng-model="x.needed" ng-options="entry.k as entry.l for entry in [{k:0, l:'N'}, {k:1,l:'Y'}]">
    </select></td><td><input disabled type="number" ng-model="x.best" step="0.01"/></td><td><input disabled type="number" ng-model="x.expected" step="0.01"/></td><td><input disabled type="number" ng-model="x.worst" step="0.01"/></td><td><input disabled type="number" ng-model="x.timeframeb" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframee" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframew" min="3" max="24" /></td><td>{{x.metric}}</td></tr>
	<tr><td colspan="3">TOTALS</td><td ng-model="SalesAllBest">{{getSalesAllBest()}}</td><td ng-model="SalesAllExpected">{{getSalesAllExpected()}}</td><td ng-model="SalesAllWorst">{{getSalesAllWorst()}}</td><td ng-model="SalesAllTFBest">{{getSalesAllTFBest()}}</td><td ng-model="SalesAllTFExpected">{{getSalesAllTFExpected()}}</td><td ng-model="SalesAllTFWorst">{{getSalesAllTFWorst()}}</td><td></td></tr>
	<tr class="hide"><td colspan="3">Factor</td><td ng-model="SalesAllBestFactor">{{getSalesAllBestFactor()}}</td><td ng-model="SalesAllExpectedFactor">{{getSalesAllExpectedFactor()}}</td><td ng-model="SalesAllWorstFactor">{{getSalesAllWorstFactor()}}</td><td></td><td></td><td></td><td></td></tr>	
</table>
</div>
<h3>CPA Data (Yes Only)</h3>
<div class="table-responsive">
<table class="optionscpaonly">
<tr><th>#</th><th>Mod</th><th>Needed</th><th>Best</th><th>Expected</th><th>Worst</th><th>Time Frame <br/>(BEST)</th><th>Time Frame <br/>(EXPECTED)</th><th>Time Frame <br/>(WORST)</th><th>Metric</th></tr>
  <tr ng-repeat="x in newoptionscpayes">
  <td>{{$index + 1}}</td><td>{{x.mod}}</td><td><select disabled ng-model="x.needed" ng-options="entry.k as entry.l for entry in [{k:0, l:'N'}, {k:1,l:'Y'}]">
    </select></td><td><input disabled type="number" ng-model="x.best" step="0.01"/></td><td><input disabled type="number" ng-model="x.expected" step="0.01"/></td><td><input disabled type="number" ng-model="x.worst" step="0.01"/></td><td><input disabled type="number" ng-model="x.timeframeb" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframee" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframew" min="3" max="24" /></td><td>{{x.metric}}</td></tr>
	<tr><td colspan="3">TOTALS</td><td ng-model="CPAYesTotalBest">{{getCPAYesTotalBest()}}</td><td ng-model="CPAYesTotalExpected">{{getCPAYesTotalExpected()}}</td><td ng-model="CPAYesTotalWorst">{{getCPAYesTotalWorst()}}</td><td ng-model="CPAYesTotalTFBest">{{getCPAYesTotalTFBest()}}</td><td ng-model="CPAYesTotalTFExpected">{{getCPAYesTotalTFExpected()}}</td><td ng-model="CPAYesTotalTFWorst">{{getCPAYesTotalTFWorst()}}</td><td></td></tr>
	<tr class="hide"><td colspan="3">Factor</td><td ng-model="CPAYesTotalBestFactor">{{getCPAYesTotalBestFactor()}}</td><td ng-model="CPAYesTotalExpectedFactor">{{getCPAYesTotalExpectedFactor()}}</td><td ng-model="CPAYesTotalWorstFactor">{{getCPAYesTotalWorstFactor()}}</td><td></td><td></td><td></td><td></td></tr>	
</table>
</div>
<h3>CPA Data (ALL)</h3>
<div class="table-responsive">
<table class="optionscpaall">
<tr><th>#</th><th>Mod</th><th>Needed</th><th>Best</th><th>Expected</th><th>Worst</th><th>Time Frame <br/>(BEST)</th><th>Time Frame <br/>(EXPECTED)</th><th>Time Frame <br/>(WORST)</th><th>Metric</th></tr>
  <tr ng-repeat="x in newoptionscpaall">
  <td>{{$index + 1}}</td><td>{{x.mod}}</td><td><select disabled ng-model="x.needed" ng-options="entry.k as entry.l for entry in [{k:0, l:'N'}, {k:1,l:'Y'}]">
    </select></td><td><input disabled type="number" ng-model="x.best" step="0.01"/></td><td><input disabled type="number" ng-model="x.expected" step="0.01"/></td><td><input disabled type="number" ng-model="x.worst" step="0.01"/></td><td><input disabled type="number" ng-model="x.timeframeb" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframee" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframew" min="3" max="24" /></td><td>{{x.metric}}</td></tr>
	<tr><td colspan="3">TOTALS</td><td ng-model="CPAAllBest">{{getCPAAllBest()}}</td><td ng-model="CPAAllExpected">{{getCPAAllExpected()}}</td><td ng-model="CPAAllWorst">{{getCPAAllWorst()}}</td><td ng-model="CPAAllTFBest">{{getCPAAllTFBest()}}</td><td ng-model="CPAAllTFExpected">{{getCPAAllTFExpected()}}</td><td ng-model="CPAAllTFWorst">{{getCPAAllTFWorst()}}</td><td></td></tr>
	<tr class="hide"><td colspan="3">Factor</td><td ng-model="CPAAllBestFactor">{{getCPAAllBestFactor()}}</td><td ng-model="CPAAllExpectedFactor">{{getCPAAllExpectedFactor()}}</td><td ng-model="CPAAllWorstFactor">{{getCPAAllWorstFactor()}}</td><td></td><td></td><td></td><td></td></tr>		
</table>
</div>
<h3>Projected Numbers</h3>
<div>
<h4>Sales</h4>
<div class="hide">
<p>{{salesbestjson | json}}</p>
<p>{{salesexpectedjson | json}}</p>
<p>{{salesworstjson | json}}</p>
<p>{{salesalljson | json}}</p>
<h4>Sales String</h4>
<p>{{salesbeststr}}</p>
<p>{{salesexpectedstr}}</p>
<p>{{salesworststr}}</p>
<p>{{salesallstr}}</p>
<h4>Sales (Merged String to JSON)</h4>
</div>
<p>{{salesjson | json}}</p>
<div class="table-responsive">
<table class="salesjson">
	<tr>
		<th>#</th><th>Name</th><th>Current</th><th>Month 1</th><th>Month 2</th><th>Month 3</th><th>Month 4</th><th>Month 5</th><th>Month 6</th><th>Month 7</th><th>Month 8</th><th>Month 9</th><th>Month 10</th><th>Month 11</th><th>Month 12</th><th>Total</th>
	</tr>
	<tr ng-repeat="x in salesjson">
		<td>{{$index + 1}}</td><td>{{x.name}}</td><td>{{x.current}}</td><td>{{x.month1}}</td><td>{{x.month2}}</td><td>{{x.month3}}</td><td>{{x.month4}}</td><td>{{x.month5}}</td><td>{{x.month6}}</td><td>{{x.month7}}</td><td>{{x.month8}}</td><td>{{x.month9}}</td><td>{{x.month10}}</td><td>{{x.month11}}</td><td>{{x.month12}}</td><td>{{x.total}}</td>
	</tr>
</table>
</div>
<h4>Gross Profit</h4>
<div class="hide">
<p>{{grossprofitbestjson | json}}</p>
<p>{{grossprofitexpectedjson | json}}</p>
<p>{{grossprofitworstjson | json}}</p>
<p>{{grossprofitalljson | json}}</p>
<h4>Gross Profit String</h4>
<p>{{grossprofitbeststr}}</p>
<p>{{grossprofitexpectedstr}}</p>
<p>{{grossprofitworststr}}</p>
<p>{{grossprofitallstr}}</p>
<h4>Gross Profit (Merged String to JSON)</h4>
</div>
<p>{{grossprofitjson | json}}</p>
<div class="table-responsive">
<table class="grossprofitjson">
	<tr>
		<th>#</th><th>Name</th><th>Current</th><th>Month 1</th><th>Month 2</th><th>Month 3</th><th>Month 4</th><th>Month 5</th><th>Month 6</th><th>Month 7</th><th>Month 8</th><th>Month 9</th><th>Month 10</th><th>Month 11</th><th>Month 12</th><th>Total</th>
	</tr>
	<tr ng-repeat="x in grossprofitjson">
		<td>{{$index + 1}}</td><td>{{x.name}}</td><td>{{x.current | currency}}</td><td>{{x.month1 | currency}}</td><td>{{x.month2 | currency}}</td><td>{{x.month3 | currency}}</td><td>{{x.month4 | currency}}</td><td>{{x.month5 | currency}}</td><td>{{x.month6 | currency}}</td><td>{{x.month7 | currency}}</td><td>{{x.month8 | currency}}</td><td>{{x.month9 | currency}}</td><td>{{x.month10 | currency}}</td><td>{{x.month11 | currency}}</td><td>{{x.month12 | currency}}</td><td>{{x.total | currency}}</td>
	</tr>
</table>
</div>
<h4>ROA</h4>
<div class="hide">
<p>{{roabestjson | json}}</p>
<p>{{roaexpectedjson | json}}</p>
<p>{{roaworstjson | json}}</p>
<p>{{roaalljson | json}}</p>
<h4>ROA String</h4>
<p>{{roabeststr}}</p>
<p>{{roaexpectedstr}}</p>
<p>{{roaworststr}}</p>
<p>{{roaallstr}}</p>
<h4>ROA (Merged String to JSON)</h4>
</div>
<p>{{roajson | json}}</p>
<div class="table-responsive">
<table class="roajson">
	<tr>
		<th>#</th><th>Name</th><th>Current</th><th>Month 1</th><th>Month 2</th><th>Month 3</th><th>Month 4</th><th>Month 5</th><th>Month 6</th><th>Month 7</th><th>Month 8</th><th>Month 9</th><th>Month 10</th><th>Month 11</th><th>Month 12</th><th>Total</th>
	</tr>
	<tr ng-repeat="x in roajson">
		<td>{{$index + 1}}</td><td>{{x.name}}</td><td>{{x.current}}</td><td>{{x.month1}}</td><td>{{x.month2}}</td><td>{{x.month3}}</td><td>{{x.month4}}</td><td>{{x.month5}}</td><td>{{x.month6}}</td><td>{{x.month7}}</td><td>{{x.month8}}</td><td>{{x.month9}}</td><td>{{x.month10}}</td><td>{{x.month11}}</td><td>{{x.month12}}</td><td>{{x.total}}</td>
	</tr>
</table>
</div>
<h4>CPA</h4>
<div class="hide">
<p>{{cpabestjson | json}}</p>
<p>{{cpaexpectedjson | json}}</p>
<p>{{cpaworstjson | json}}</p>
<p>{{cpaalljson | json}}</p>
<h4>CPA String</h4>
<p>{{cpabeststr}}</p>
<p>{{cpaexpectedstr}}</p>
<p>{{cpaworststr}}</p>
<p>{{cpaallstr}}</p>
<h4>CPA (Merged String to JSON)</h4>
</div>
<p>{{cpajson | json}}</p>
<div class="table-responsive">
<table class="cpajson">
	<tr>
		<th>#</th><th>Name</th><th>Current</th><th>Month 1</th><th>Month 2</th><th>Month 3</th><th>Month 4</th><th>Month 5</th><th>Month 6</th><th>Month 7</th><th>Month 8</th><th>Month 9</th><th>Month 10</th><th>Month 11</th><th>Month 12</th><th>Total</th>
	</tr>
	<tr ng-repeat="x in cpajson">
		<td>{{$index + 1}}</td><td>{{x.name}}</td><td>{{x.current}}</td><td>{{x.month1}}</td><td>{{x.month2}}</td><td>{{x.month3}}</td><td>{{x.month4}}</td><td>{{x.month5}}</td><td>{{x.month6}}</td><td>{{x.month7}}</td><td>{{x.month8}}</td><td>{{x.month9}}</td><td>{{x.month10}}</td><td>{{x.month11}}</td><td>{{x.month12}}</td><td>{{x.total}}</td>
	</tr>
</table>
</div>
<h4>Budget</h4>
<div class="hide">
<p>{{budgetbestjson | json}}</p>
<p>{{budgetexpectedjson | json}}</p>
<p>{{budgetworstjson | json}}</p>
<p>{{budgetalljson | json}}</p>
<h4>Budget String</h4>
<p>{{budgetbeststr}}</p>
<p>{{budgetexpectedstr}}</p>
<p>{{budgetworststr}}</p>
<p>{{budgetallstr}}</p>
<h4>Budget (Merged String to JSON)</h4>
</div>
<p>{{budgetjson | json}}</p>
<div class="table-responsive">
<table class="budgetjson">
	<tr>
		<th>#</th><th>Name</th><th>Current</th><th>Month 1</th><th>Month 2</th><th>Month 3</th><th>Month 4</th><th>Month 5</th><th>Month 6</th><th>Month 7</th><th>Month 8</th><th>Month 9</th><th>Month 10</th><th>Month 11</th><th>Month 12</th><th>Total</th>
	</tr>
	<tr ng-repeat="x in budgetjson">
		<td>{{$index + 1}}</td><td>{{x.name}}</td><td>{{x.current}}</td><td>{{x.month1}}</td><td>{{x.month2}}</td><td>{{x.month3}}</td><td>{{x.month4}}</td><td>{{x.month5}}</td><td>{{x.month6}}</td><td>{{x.month7}}</td><td>{{x.month8}}</td><td>{{x.month9}}</td><td>{{x.month10}}</td><td>{{x.month11}}</td><td>{{x.month12}}</td><td>{{x.total}}</td>
	</tr>
</table>
</div>
</div>
</div>

<script src="js/angular.min.js" type='text/javascript'></script>
<script src="js/jquery-1.12.4.min.js" type='text/javascript'></script>
<script src="js/bootstrap.min.js" type='text/javascript'></script>
<script type='text/javascript'>
	var app = angular.module('myApp', []);
	app.controller("myCtrl", function($scope) {
		$scope.options = [
			{mod:'Correct Pixel Implementation',metric:'CPA',needed:0,best:-0.05,expected:-0.02,worst:-0.01,timeframeb:6,timeframee:12,timeframew:18},
			{mod:'DPA (Dynamic Product Ads)',metric:'Sales',needed:0,best:0.2,expected:0.1,worst:0.05,timeframeb:6,timeframee:12,timeframew:18},
			{mod:'Naming Convention',metric:'CPA',needed:0,best:-0.05,expected:-0.02,worst:-0.01,timeframeb:6,timeframee:12,timeframew:18},
			{mod:'Daily optimizations',metric:'Sales',needed:0,best:0.1,expected:0.05,worst:0.02,timeframeb:6,timeframee:12,timeframew:18},
			{mod:'Dedicated person running accounts',metric:'Sales',needed:0,best:0.3,expected:0.2,worst:0.1,timeframeb:6,timeframee:12,timeframew:18}
		];
		$scope.orig = angular.copy($scope.options);
		
		$scope.reset = function() {
			$scope.options = angular.copy($scope.orig);
			$scope.newoptions = [];
			$scope.newoptionssalesyes = [];
			$scope.newoptionssalesall = [];
			$scope.newoptionscpayes = [];
			$scope.newoptionscpaall = [];
			$scope.salesjson = [];
			$scope.salesbestjson = [];
			$scope.salesexpectedjson = [];
			$scope.salesworstjson = [];
			$scope.salesalljson = [];
			$scope.grossprofitjson = [];
			$scope.grossprofitbestjson = [];
			$scope.grossprofitexpectedjson = [];
			$scope.grossprofitworstjson = [];
			$scope.grossprofitalljson = [];
			$scope.roajson = [];
			$scope.roabestjson = [];
			$scope.roaexpectedjson = [];
			$scope.roaworstjson = [];
			$scope.roaalljson = [];
			$scope.cpajson = [];
			$scope.cpabestjson = [];
			$scope.cpaexpectedjson = [];
			$scope.cpaworstjson = [];
			$scope.cpaalljson = [];
			$scope.budgetjson = [];
			$scope.budgetbestjson = [];
			$scope.budgetexpectedjson = [];
			$scope.budgetworstjson = [];
			$scope.budgetalljson = [];			
		};
		
		$scope.months = 12;
		$scope.cpa = 20;
		$scope.monthlysales = 150;
		$scope.aveordervalue = 65.78;
		$scope.monthlyadspend = 6000;
		$scope.estimatednewspend = function() { $scope.estimatedcurrentspend = $scope.cpa * $scope.monthlysales; return $scope.estimatedcurrentspend};
		$scope.newroa = function() { $scope.currentroa =  $scope.estimatedcurrentgross / $scope.monthlyadspend; return $scope.currentroa};
		$scope.estimatednewgross = function() { $scope.estimatedcurrentgross = $scope.monthlysales * $scope.aveordervalue; return $scope.estimatedcurrentgross};
		

 		$scope.update = function (){
			$scope.newoptions = [];
			$scope.newoptionssalesyes = [];
			$scope.newoptionssalesall = [];
			$scope.newoptionscpayes = [];
			$scope.newoptionscpaall = [];

			$scope.salesjson = [];
			$scope.salesbestjson = [];
			$scope.salesexpectedjson = [];
			$scope.salesworstjson = [];
			$scope.salesalljson = [];
			$scope.grossprofitjson = [];
			$scope.grossprofitbestjson = [];
			$scope.grossprofitexpectedjson = [];
			$scope.grossprofitworstjson = [];
			$scope.grossprofitalljson = [];
			$scope.roajson = [];
			$scope.roabestjson = [];
			$scope.roaexpectedjson = [];
			$scope.roaworstjson = [];
			$scope.roaalljson = [];
			$scope.cpajson = [];
			$scope.cpabestjson = [];
			$scope.cpaexpectedjson = [];
			$scope.cpaworstjson = [];
			$scope.cpaalljson = [];
			$scope.budgetjson = [];
			$scope.budgetbestjson = [];
			$scope.budgetexpectedjson = [];
			$scope.budgetworstjson = [];
			$scope.budgetalljson = [];			

			angular.forEach($scope.options, function (value, key) {
				if (value.metric=='Sales'){
					if (value.needed==1){
						$scope.newoptionssalesyes.push({ mod: value.mod, metric: value.metric, needed: value.needed, best: value.best, expected: value.expected, worst: value.worst, timeframeb: value.timeframeb, timeframee: value.timeframee, timeframew: value.timeframew  });
					}
					$scope.newoptionssalesall.push({ mod: value.mod, metric: value.metric, needed: value.needed, best: value.best, expected: value.expected, worst: value.worst, timeframeb: value.timeframeb, timeframee: value.timeframee, timeframew: value.timeframew  });
				} else if (value.metric=='CPA'){
					if (value.needed==1){
						$scope.newoptionscpayes.push({ mod: value.mod, metric: value.metric, needed: value.needed, best: value.best, expected: value.expected, worst: value.worst, timeframeb: value.timeframeb, timeframee: value.timeframee, timeframew: value.timeframew  });
					}					
					$scope.newoptionscpaall.push({ mod: value.mod, metric: value.metric, needed: value.needed, best: value.best, expected: value.expected, worst: value.worst, timeframeb: value.timeframeb, timeframee: value.timeframee, timeframew: value.timeframew  });
				}
				
                $scope.newoptions.push({ mod: value.mod, metric: value.metric, needed: value.needed, best: value.best, expected: value.expected, worst: value.worst, timeframeb: value.timeframeb, timeframee: value.timeframee, timeframew: value.timeframew  });
               });
			   
			$scope.getSalesYesTotalBest = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesyes.length; i++){
					var x = $scope.newoptionssalesyes[i];
					total += (x.best);
				}
				return total.toFixed(2);
			}
			$scope.getSalesYesTotalExpected = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesyes.length; i++){
					var x = $scope.newoptionssalesyes[i];
					total += (x.expected);
				}
				return total.toFixed(2);
			}
			$scope.getSalesYesTotalWorst = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesyes.length; i++){
					var x = $scope.newoptionssalesyes[i];
					total += (x.worst);
				}
				return total.toFixed(2);
			}
			$scope.getSalesYesTotalTFBest = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesyes.length; i++){
					var x = $scope.newoptionssalesyes[i];
					total += (x.timeframeb);
				}

				return total.toFixed(0);
			}
			$scope.getSalesYesTotalTFExpected = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesyes.length; i++){
					var x = $scope.newoptionssalesyes[i];
					total += (x.timeframee);
				}

				return total.toFixed(0);
			}
			$scope.getSalesYesTotalTFWorst = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesyes.length; i++){
					var x = $scope.newoptionssalesyes[i];
					total += (x.timeframew);
				}

				return total.toFixed(0);
			}

			
			$scope.getSalesAllBest = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesall.length; i++){
					var x = $scope.newoptionssalesall[i];
					total += (x.best);
				}
				return total.toFixed(2);
			}
			$scope.getSalesAllExpected = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesall.length; i++){
					var x = $scope.newoptionssalesall[i];
					total += (x.expected);
				}
				return total.toFixed(2);
			}
			$scope.getSalesAllWorst = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesall.length; i++){
					var x = $scope.newoptionssalesall[i];
					total += (x.worst);
				}
				return total.toFixed(2);
			}
			$scope.getSalesAllTFBest = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesall.length; i++){
					var x = $scope.newoptionssalesall[i];
					total += (x.timeframeb);
				}
				return total.toFixed(0);
			}
			$scope.getSalesAllTFExpected = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesall.length; i++){
					var x = $scope.newoptionssalesall[i];
					total += (x.timeframee);
				}
				return total.toFixed(0);
			}
			$scope.getSalesAllTFWorst = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionssalesall.length; i++){
					var x = $scope.newoptionssalesall[i];
					total += (x.timeframew);
				}
				return total.toFixed(0);
			}			
			
			$scope.getCPAYesTotalBest = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpayes.length; i++){
					var x = $scope.newoptionscpayes[i];
					total += (x.best);
				}
				return total.toFixed(2);
			}
			$scope.getCPAYesTotalExpected = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpayes.length; i++){
					var x = $scope.newoptionscpayes[i];
					total += (x.expected);
				}
				return total.toFixed(2);
			}
			$scope.getCPAYesTotalWorst = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpayes.length; i++){
					var x = $scope.newoptionscpayes[i];
					total += (x.worst);
				}
				return total.toFixed(2);
			}
			$scope.getCPAYesTotalTFBest = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpayes.length; i++){
					var x = $scope.newoptionscpayes[i];
					total += (x.timeframeb);
				}

				return total.toFixed(0);
			}
			$scope.getCPAYesTotalTFExpected = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpayes.length; i++){
					var x = $scope.newoptionscpayes[i];
					total += (x.timeframee);
				}

				return total.toFixed(0);
			}
			$scope.getCPAYesTotalTFWorst = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpayes.length; i++){
					var x = $scope.newoptionscpayes[i];
					total += (x.timeframew);
				}

				return total.toFixed(0);
			}

			$scope.getCPAAllBest = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpaall.length; i++){
					var x = $scope.newoptionscpaall[i];
					total += (x.best);
				}
				return total.toFixed(2);
			}
			$scope.getCPAAllExpected = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpaall.length; i++){
					var x = $scope.newoptionscpaall[i];
					total += (x.expected);
				}
				return total.toFixed(2);
			}
			$scope.getCPAAllWorst = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpaall.length; i++){
					var x = $scope.newoptionscpaall[i];
					total += (x.worst);
				}
				return total.toFixed(2);
			}
			$scope.getCPAAllTFBest = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpaall.length; i++){
					var x = $scope.newoptionscpaall[i];
					total += (x.timeframeb);
				}
				return total.toFixed(0);
			}
			$scope.getCPAAllTFExpected = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpaall.length; i++){
					var x = $scope.newoptionscpaall[i];
					total += (x.timeframee);
				}
				return total.toFixed(0);
			}
			$scope.getCPAAllTFWorst = function(){
				var total = 0;
				for(var i = 0; i < $scope.newoptionscpaall.length; i++){
					var x = $scope.newoptionscpaall[i];
					total += (x.timeframew);
				}
				return total.toFixed(0);
			}

			$scope.getSalesYesTotalBestFactor = function(){
				var factor = $scope.getSalesYesTotalBest() / $scope.getSalesYesTotalTFBest();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;
			}
			$scope.getSalesYesTotalExpectedFactor = function(){
				var factor = $scope.getSalesYesTotalExpected() / $scope.getSalesYesTotalTFExpected();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;				
			}
			$scope.getSalesYesTotalWorstFactor = function(){
				var factor = $scope.getSalesYesTotalWorst() / $scope.getSalesYesTotalTFWorst();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;				
			}
			
			$scope.getSalesAllBestFactor = function(){
				var factor = $scope.getSalesAllBest() / $scope.getSalesAllTFBest();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;
			}
			$scope.getSalesAllExpectedFactor = function(){
				var factor = $scope.getSalesAllExpected() / $scope.getSalesAllTFExpected();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;				
			}
			$scope.getSalesAllWorstFactor = function(){
				var factor = $scope.getSalesAllWorst() / $scope.getSalesAllTFWorst();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;				
			}
			
			$scope.getCPAYesTotalBestFactor = function(){
				var factor = $scope.getCPAYesTotalBest() / $scope.getCPAYesTotalTFBest();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;
			}
			$scope.getCPAYesTotalExpectedFactor = function(){
				var factor = $scope.getCPAYesTotalExpected() / $scope.getCPAYesTotalTFExpected();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;				
			}
			$scope.getCPAYesTotalWorstFactor = function(){
				var factor = $scope.getCPAYesTotalWorst() / $scope.getCPAYesTotalTFWorst();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;				
			}

			$scope.getCPAAllBestFactor = function(){
				var factor = $scope.getCPAAllBest() / $scope.getCPAAllTFBest();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;
			}
			$scope.getCPAAllExpectedFactor = function(){
				var factor = $scope.getCPAAllExpected() / $scope.getCPAAllTFExpected();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;				
			}
			$scope.getCPAAllWorstFactor = function(){
				var factor = $scope.getCPAAllWorst() / $scope.getCPAAllTFWorst();
				if (typeof factor === 'number' && isNaN(factor)) {
					return (0).toFixed(2);
				}
				return factor;				
			}

			//Projected Numbers (SALES)
			var salesbestbase = $scope.monthlysales;
			var salesbestbasetotal = 0;
			$scope.salesbeststr = '{' + '"name": "Sales Best", "current":' + round(salesbestbase,0) + '';
			for (i = 0; i < $scope.months; i++){
				salesbestbase = salesbestbase + (salesbestbase * $scope.getSalesYesTotalBestFactor());
				$scope.salesbestjson.push(salesbestbase);
				salesbestbasetotal += salesbestbase;
				$scope.salesbeststr += ', "month' + (i+1).toString() + '":' + round(salesbestbase,0);
			}
			$scope.salesbeststr += ', "total":' + round((salesbestbasetotal),0) + '}';
			
			var salesexpectedbase = $scope.monthlysales;
			var salesexpectedbasetotal = 0;
			$scope.salesexpectedstr = '{' + '"name": "Sales Expected", "current":' + round(salesexpectedbase,0) + '';
			for (i = 0; i < $scope.months; i++){
				salesexpectedbase = salesexpectedbase + (salesexpectedbase * $scope.getSalesYesTotalExpectedFactor());
				$scope.salesexpectedjson.push(salesexpectedbase);
				salesexpectedbasetotal += salesexpectedbase;
				$scope.salesexpectedstr += ', "month' + (i+1).toString() + '":' + round(salesexpectedbase,0);
			}		
			$scope.salesexpectedstr += ', "total":' + round((salesexpectedbasetotal),0) + '}';
			
			var salesworstbase = $scope.monthlysales;
			var salesworstbasetotal = 0;
			$scope.salesworststr = '{' + '"name": "Sales Worst", "current":' + round(salesworstbase,0) + '';
			for (i = 0; i < $scope.months; i++){
				salesworstbase = salesworstbase + (salesworstbase * $scope.getSalesYesTotalWorstFactor());
				$scope.salesworstjson.push(salesworstbase);
				salesworstbasetotal += salesworstbase;
				$scope.salesworststr += ', "month' + (i+1).toString() + '":' + round(salesworstbase,0);
			}
			$scope.salesworststr += ', "total":' + round((salesworstbasetotal),0) + '}';
			
			var salesallbase = $scope.monthlysales;
			var salesallbasetotal = 0;
			$scope.salesallstr = '{' + '"name": "Sales All Options", "current":' + round(salesallbase,0) + '';
			for (i = 0; i < $scope.months; i++){
				salesallbase = salesallbase + (salesallbase * $scope.getSalesAllBestFactor());
				$scope.salesalljson.push(salesallbase);
				salesallbasetotal += salesallbase;
				$scope.salesallstr += ', "month' + (i+1).toString() + '":' + round(salesallbase,0);
			}		
			$scope.salesallstr += ', "total":' + round((salesallbasetotal),0) + '}';
			
			$scope.salesjson = [];
			$scope.salesjson.push(JSON.parse($scope.salesbeststr));
			$scope.salesjson.push(JSON.parse($scope.salesexpectedstr));
			$scope.salesjson.push(JSON.parse($scope.salesworststr));
			$scope.salesjson.push(JSON.parse($scope.salesallstr));
			
			
			//Projected Numbers (Gross Profit)
			var grossprofitbestbase = 0;
			var grossprofitbestbasetotal = 0;
			var count = 0;
			$scope.grossprofitbeststr = '{' + '"name": "Gross Profit Best", "current":' + round(($scope.monthlysales * $scope.aveordervalue),2) + '';
			for (i = 0; i < $scope.months; i++){
				grossprofitbestbase = $scope.salesbestjson[i] * $scope.aveordervalue;
				grossprofitbestbasetotal += grossprofitbestbase;
				$scope.grossprofitbestjson.push(grossprofitbestbase);
				$scope.grossprofitbeststr += ', "month' + (i+1).toString() + '":' + round(grossprofitbestbase,2);
			}			
			$scope.grossprofitbeststr += ', "total":' + round((grossprofitbestbasetotal),2) + '}';
			
			var grossprofitexpectedbase = 0;
			var grossprofitexpectedbasetotal = 0;
			var count = 0;
			$scope.grossprofitexpectedstr = '{' + '"name": "Gross Profit Expected", "current":' + round(($scope.monthlysales * $scope.aveordervalue),2) + '';
			for (i = 0; i < $scope.months; i++){
				grossprofitexpectedbase = $scope.salesexpectedjson[i] * $scope.aveordervalue;
				grossprofitexpectedbasetotal += grossprofitexpectedbase;
				$scope.grossprofitexpectedjson.push(grossprofitexpectedbase);
				$scope.grossprofitexpectedstr += ', "month' + (i+1).toString() + '":' + round(grossprofitexpectedbase,2);
			}			
			$scope.grossprofitexpectedstr += ', "total":' + round((grossprofitexpectedbasetotal),2) + '}';

			var grossprofitworstbase = 0;
			var grossprofitworstbasetotal = 0;
			var count = 0;
			$scope.grossprofitworststr = '{' + '"name": "Gross Profit Worst", "current":' + round(($scope.monthlysales * $scope.aveordervalue),2) + '';
			for (i = 0; i < $scope.months; i++){
				grossprofitworstbase = $scope.salesworstjson[i] * $scope.aveordervalue;
				grossprofitworstbasetotal += grossprofitworstbase;
				$scope.grossprofitworstjson.push(grossprofitworstbase);
				$scope.grossprofitworststr += ', "month' + (i+1).toString() + '":' + round(grossprofitworstbase,2);
			}			
			$scope.grossprofitworststr += ', "total":' + round((grossprofitworstbasetotal),2) + '}';
			
			var grossprofitallbase = 0;
			var grossprofitallbasetotal = 0;
			var count = 0;
			$scope.grossprofitallstr = '{' + '"name": "Gross Profit All Options", "current":' + round(($scope.monthlysales * $scope.aveordervalue),2) + '';
			for (i = 0; i < $scope.months; i++){
				grossprofitallbase = $scope.salesalljson[i] * $scope.aveordervalue;
				grossprofitallbasetotal += grossprofitallbase;
				$scope.grossprofitalljson.push(grossprofitallbase);
				$scope.grossprofitallstr += ', "month' + (i+1).toString() + '":' + round(grossprofitallbase,2);
			}			
			$scope.grossprofitallstr += ', "total":' + round((grossprofitallbasetotal),2) + '}';

			$scope.grossprofitjson = [];
			$scope.grossprofitjson.push(JSON.parse($scope.grossprofitbeststr));
			$scope.grossprofitjson.push(JSON.parse($scope.grossprofitexpectedstr));
			$scope.grossprofitjson.push(JSON.parse($scope.grossprofitworststr));
			$scope.grossprofitjson.push(JSON.parse($scope.grossprofitallstr));


			//Projected Numbers (ROA)
			var roabestbase = 0;
			var roabestbasetotal = 0;
			var count = 0;
			$scope.roabeststr = '{' + '"name": "ROA Best", "current":' + round((($scope.estimatedcurrentgross / $scope.monthlyadspend)*100),2) + '';
			for (i = 0; i < $scope.months; i++){
				roabestbase = $scope.grossprofitbestjson[i] / $scope.monthlyadspend;
				roabestbasetotal += roabestbase;
				$scope.roabestjson.push(roabestbase);
				count += 1;
				$scope.roabeststr += ', "month' + (i+1).toString() + '":' + round((roabestbase*100),2);
			}			
			$scope.roabeststr += ', "total":' + round(((roabestbasetotal*100)/ count),2) + '}';
			
			var roaexpectedbase = 0;
			var roaexpectedbasetotal = 0;
			var count = 0;
			$scope.roaexpectedstr = '{' + '"name": "ROA Expected", "current":' + round((($scope.estimatedcurrentgross / $scope.monthlyadspend)*100),2) + '';
			for (i = 0; i < $scope.months; i++){
				roaexpectedbase = $scope.grossprofitexpectedjson[i] / $scope.monthlyadspend;
				roaexpectedbasetotal += roaexpectedbase;
				$scope.roaexpectedjson.push(roaexpectedbase);
				count += 1;
				$scope.roaexpectedstr += ', "month' + (i+1).toString() + '":' + round((roaexpectedbase*100),2);
			}			
			$scope.roaexpectedstr += ', "total":' + round(((roaexpectedbasetotal*100)/ count),2) + '}';
			
			var roaworstbase = 0;
			var roaworstbasetotal = 0;
			var count = 0;
			$scope.roaworststr = '{' + '"name": "ROA Worst", "current":' + round((($scope.estimatedcurrentgross / $scope.monthlyadspend)*100),2) + '';
			for (i = 0; i < $scope.months; i++){
				roaworstbase = $scope.grossprofitworstjson[i] / $scope.monthlyadspend;
				roaworstbasetotal += roaworstbase;
				$scope.roaworstjson.push(roaworstbase);
				count += 1;
				$scope.roaworststr += ', "month' + (i+1).toString() + '":' + round((roaworstbase*100),2);
			}			
			$scope.roaworststr += ', "total":' + round(((roaworstbasetotal*100)/ count),2) + '}';
			
			var roaallbase = 0;
			var roaallbasetotal = 0;
			var count = 0;
			$scope.roaallstr = '{' + '"name": "ROA All Options", "current":' + round((($scope.estimatedcurrentgross / $scope.monthlyadspend)*100),2) + '';
			for (i = 0; i < $scope.months; i++){
				roaallbase = $scope.grossprofitalljson[i] / $scope.monthlyadspend;
				roaallbasetotal += roaallbase;
				$scope.roaalljson.push(roaallbase);
				count += 1;
				$scope.roaallstr += ', "month' + (i+1).toString() + '":' + round((roaallbase*100),2);
			}			
			$scope.roaallstr += ', "total":' + round(((roaallbasetotal*100)/ count),2) + '}';

			$scope.roajson = [];
			$scope.roajson.push(JSON.parse($scope.roabeststr));
			$scope.roajson.push(JSON.parse($scope.roaexpectedstr));
			$scope.roajson.push(JSON.parse($scope.roaworststr));
			$scope.roajson.push(JSON.parse($scope.roaallstr));			
			
			//Projected Numbers (CPA)
			var cpabestbase = $scope.cpa;
			var cpabestbasetotal = 0;
			var count = 0;
			$scope.cpabeststr = '{' + '"name": "CPA Best", "current":' + round(cpabestbase,2) + '';
			for (i = 0; i < $scope.months; i++){
				cpabestbase = cpabestbase + (cpabestbase * $scope.getCPAYesTotalBestFactor());
				$scope.cpabestjson.push((cpabestbase));
				cpabestbasetotal += cpabestbase;
				count += 1;
				$scope.cpabeststr += ', "month' + (i+1).toString() + '":' + round(cpabestbase,2);
			}
			$scope.cpabeststr += ', "total":' + round((cpabestbasetotal/count),2) + '}';
			
			var cpaexpectedbase = $scope.cpa;
			var cpaexpectedbasetotal = 0;
			var count = 0;
			$scope.cpaexpectedstr = '{' + '"name": "CPA Expected", "current":' + round(cpaexpectedbase,2) + '';
			for (i = 0; i < $scope.months; i++){
				cpaexpectedbase = cpaexpectedbase + (cpaexpectedbase * $scope.getCPAYesTotalExpectedFactor());
				$scope.cpaexpectedjson.push((cpaexpectedbase));
				cpaexpectedbasetotal += cpaexpectedbase;
				count += 1;
				$scope.cpaexpectedstr += ', "month' + (i+1).toString() + '":' + round(cpaexpectedbase,2);
			}		
			$scope.cpaexpectedstr += ', "total":' + round((cpaexpectedbasetotal/count),2) + '}';
			
			var cpaworstbase = $scope.cpa;
			var cpaworstbasetotal = 0;
			var count = 0;
			$scope.cpaworststr = '{' + '"name": "CPA Worst", "current":' + round(cpaworstbase,2) + '';
			for (i = 0; i < $scope.months; i++){
				cpaworstbase = cpaworstbase + (cpaworstbase * $scope.getCPAYesTotalWorstFactor());
				$scope.cpaworstjson.push((cpaworstbase));
				cpaworstbasetotal += cpaworstbase;
				count += 1;
				$scope.cpaworststr += ', "month' + (i+1).toString() + '":' + round(cpaworstbase,2);
			}
			$scope.cpaworststr += ', "total":' + round((cpaworstbasetotal/count),2) + '}';
			
			var cpaallbase = $scope.cpa;
			var cpaallbasetotal = 0;
			var count = 0;
			$scope.cpaallstr = '{' + '"name": "CPA All Options", "current":' + round(cpaallbase,2) + '';
			for (i = 0; i < $scope.months; i++){
				cpaallbase = cpaallbase + (cpaallbase * $scope.getCPAAllBestFactor());
				$scope.cpaalljson.push((cpaallbase));
				cpaallbasetotal += cpaallbase;
				count += 1;
				$scope.cpaallstr += ', "month' + (i+1).toString() + '":' + round(cpaallbase,2);
			}		
			$scope.cpaallstr += ', "total":' + round((cpaallbasetotal/count),2) + '}';

			$scope.cpajson = [];
			$scope.cpajson.push(JSON.parse($scope.cpabeststr));
			$scope.cpajson.push(JSON.parse($scope.cpaexpectedstr));
			$scope.cpajson.push(JSON.parse($scope.cpaworststr));
			$scope.cpajson.push(JSON.parse($scope.cpaallstr));			

			
			//Projected Numbers (BUDGET)
			var budgetbestbase = $scope.monthlyadspend;
			var budgetbestbasetotal = 0;
			var count = 0;
			$scope.budgetbeststr = '{' + '"name": "Budget Best", "current":' + round(budgetbestbase,2) + '';
			for (i = 0; i < $scope.months; i++){
				budgetbestbase = $scope.salesbestjson[i] * $scope.cpabestjson[i];
				$scope.budgetbestjson.push((budgetbestbase));
				budgetbestbasetotal += budgetbestbase;
				count += 1;
				$scope.budgetbeststr += ', "month' + (i+1).toString() + '":' + round(budgetbestbase,2);
			}
			$scope.budgetbeststr += ', "total":' + round((budgetbestbasetotal/count),2) + '}';
			
			var budgetexpectedbase = $scope.monthlyadspend;
			var budgetexpectedbasetotal = 0;
			var count = 0;
			$scope.budgetexpectedstr = '{' + '"name": "Budget Expected", "current":' + round(budgetexpectedbase,2) + '';
			for (i = 0; i < $scope.months; i++){
				budgetexpectedbase = $scope.salesexpectedjson[i] * $scope.cpaexpectedjson[i];
				$scope.budgetexpectedjson.push((budgetexpectedbase));
				budgetexpectedbasetotal += budgetexpectedbase;
				count += 1;
				$scope.budgetexpectedstr += ', "month' + (i+1).toString() + '":' + round(budgetexpectedbase,2);
			}
			$scope.budgetexpectedstr += ', "total":' + round((budgetexpectedbasetotal/count),2) + '}';
			
			var budgetworstbase = $scope.monthlyadspend;
			var budgetworstbasetotal = 0;
			var count = 0;
			$scope.budgetworststr = '{' + '"name": "Budget Worst", "current":' + round(budgetworstbase,2) + '';
			for (i = 0; i < $scope.months; i++){
				budgetworstbase = $scope.salesworstjson[i] * $scope.cpaworstjson[i];
				$scope.budgetworstjson.push((budgetworstbase));
				budgetworstbasetotal += budgetworstbase;
				count += 1;
				$scope.budgetworststr += ', "month' + (i+1).toString() + '":' + round(budgetworstbase,2);
			}
			$scope.budgetworststr += ', "total":' + round((budgetworstbasetotal/count),2) + '}';
			
			var budgetallbase = $scope.monthlyadspend;
			var budgetallbasetotal = 0;
			var count = 0;
			$scope.budgetallstr = '{' + '"name": "Budget All Options", "current":' + round(budgetallbase,2) + '';
			for (i = 0; i < $scope.months; i++){
				budgetallbase = $scope.salesalljson[i] * $scope.cpaalljson[i];
				$scope.budgetalljson.push((budgetallbase));
				budgetallbasetotal += budgetallbase;
				count += 1;
				$scope.budgetallstr += ', "month' + (i+1).toString() + '":' + round(budgetallbase,2);
			}
			$scope.budgetallstr += ', "total":' + round((budgetallbasetotal/count),2) + '}';
			
			$scope.budgetjson = [];
			$scope.budgetjson.push(JSON.parse($scope.budgetbeststr));
			$scope.budgetjson.push(JSON.parse($scope.budgetexpectedstr));
			$scope.budgetjson.push(JSON.parse($scope.budgetworststr));
			$scope.budgetjson.push(JSON.parse($scope.budgetallstr));				
		}
	});

	app.filter('percentage', ['$filter', function ($filter) {
	  return function (input, decimals) {
		return $filter('number')(input * 100, decimals);
	  };
	}]);
	function round(value, precision) {
	  if (Number.isInteger(precision)) {
		var shift = Math.pow(10, precision);
		return Math.round(value * shift) / shift;
	  } else {
		return Math.round(value);
	  }
	}
</script>
</body>
</html>