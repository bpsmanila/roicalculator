<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

<body>

<div ng-app="myApp" ng-controller="myCtrl">

<h3>Current Situation Questions</h3>
<form>
<p>Cost Per Acquisition ($) <input type="number" ng-model="cpa"/></p>
<p>Monthly Sales <input type="number" ng-model="monthlysales"/></p>
<p>Average Order Value (AOV) ($) <input type="number" ng-model="aveordervalue"/></p>
<p>Monthly Ad Spend ($) <input type="number" ng-model="monthlyadspend"/></p>
<p>Current ROA (%) <span class="currentroa percentage">{{newroa() | percentage:2}}%</span><input type="number" ng-model="currentroa" bound-model="newroa()" disabled /></p>
<p>Current Gross <span class="currentgross currency">{{newgross() | currency}}</span><input type="number" ng-model="currentgross" bound-model="newgross()" disabled /></p>
<p>Gross Profit <span class="currentgrossprofit currency">{{newgrossprofit() | currency}}</span><input type="number" ng-model="currentgrossprofit" bound-model="newgrossprofit()" disabled /></p>
</form>
<h3>Options</h3>
<table class="options">
<tr><th>#</th><th>Mod</th><th>Needed</th><th>Best</th><th>Expected</th><th>Worst</th><th>Time Frame <br/>(BEST)</th><th>Time Frame <br/>(EXPECTED)</th><th>Time Frame <br/>(WORST)</th><th>Metric</th></tr>
  <tr ng-repeat="x in options">
  <td>{{$index + 1}}</td><td>{{x.mod}}</td><td><select ng-model="x.needed" ng-options="entry.k as entry.l for entry in [{k:0, l:'N'}, {k:1,l:'Y'}]">
    </select></td><td><input type="number" ng-model="x.best" step="0.01"/></td><td><input type="number" ng-model="x.expected" step="0.01"/></td><td><input type="number" ng-model="x.worst" step="0.01"/></td><td><input type="number" ng-model="x.timeframeb" min="3" max="24" /></td><td><input type="number" ng-model="x.timeframee" min="3" max="24" /></td><td><input type="number" ng-model="x.timeframew" min="3" max="24" /></td><td>{{x.metric}}</td></tr>
</table>
<input type="button" id="btnreset" ng-click="reset()" value="Reset Options" /><input type="button" id="btnsubmit" ng-click="update()" value="Update Options" />

<div class="hide">
<p>{{newoptions | json}}</p>
<p>{{newoptionssalesyes | json}}</p>
<p>{{newoptionssalesall | json}}</p>
<p>{{newoptionscpayes | json}}</p>
<p>{{newoptionscpaall | json}}</p>
</div>
<h3>Sales Data (Yes Only)</h3>
<table class="optionssalesonly">
<tr><th>#</th><th>Mod</th><th>Needed</th><th>Best</th><th>Expected</th><th>Worst</th><th>Time Frame <br/>(BEST)</th><th>Time Frame <br/>(EXPECTED)</th><th>Time Frame <br/>(WORST)</th><th>Metric</th></tr>
  <tr ng-repeat="x in newoptionssalesyes">
  <td>{{$index + 1}}</td><td>{{x.mod}}</td><td><select disabled ng-model="x.needed" ng-options="entry.k as entry.l for entry in [{k:0, l:'N'}, {k:1,l:'Y'}]">
    </select></td><td><input disabled type="number" ng-model="x.best" step="0.01"/></td><td><input disabled type="number" ng-model="x.expected" step="0.01"/></td><td><input disabled type="number" ng-model="x.worst" step="0.01"/></td><td><input disabled type="number" ng-model="x.timeframeb" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframee" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframew" min="3" max="24" /></td><td>{{x.metric}}</td></tr>
	<tr><td colspan="3">TOTALS</td><td ng-model="SalesYesTotalBest">{{getSalesYesTotalBest()}}</td><td ng-model="SalesYesTotalExpected">{{getSalesYesTotalExpected()}}</td><td ng-model="SalesYesTotalWorst">{{getSalesYesTotalWorst()}}</td><td ng-model="SalesYesTotalTFBest">{{getSalesYesTotalTFBest()}}</td><td ng-model="SalesYesTotalTFExpected">{{getSalesYesTotalTFExpected()}}</td><td ng-model="SalesYesTotalTFWorst">{{getSalesYesTotalTFWorst()}}</td><td></td></tr>
	<tr><td colspan="3">Factor</td><td ng-model="SalesYesTotalBestFactor">{{getSalesYesTotalBestFactor()}}</td><td ng-model="SalesYesTotalExpectedFactor">{{getSalesYesTotalExpectedFactor()}}</td><td ng-model="SalesYesTotalWorstFactor">{{getSalesYesTotalWorstFactor()}}</td><td></td><td></td><td></td><td></td></tr>
</table>

<h3>Sales Data (ALL)</h3>
<table class="optionssalesall">
<tr><th>#</th><th>Mod</th><th>Needed</th><th>Best</th><th>Expected</th><th>Worst</th><th>Time Frame <br/>(BEST)</th><th>Time Frame <br/>(EXPECTED)</th><th>Time Frame <br/>(WORST)</th><th>Metric</th></tr>
  <tr ng-repeat="x in newoptionssalesall">
  <td>{{$index + 1}}</td><td>{{x.mod}}</td><td><select disabled ng-model="x.needed" ng-options="entry.k as entry.l for entry in [{k:0, l:'N'}, {k:1,l:'Y'}]">
    </select></td><td><input disabled type="number" ng-model="x.best" step="0.01"/></td><td><input disabled type="number" ng-model="x.expected" step="0.01"/></td><td><input disabled type="number" ng-model="x.worst" step="0.01"/></td><td><input disabled type="number" ng-model="x.timeframeb" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframee" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframew" min="3" max="24" /></td><td>{{x.metric}}</td></tr>
	<tr><td colspan="3">TOTALS</td><td ng-model="SalesAllBest">{{getSalesAllBest()}}</td><td ng-model="SalesAllExpected">{{getSalesAllExpected()}}</td><td ng-model="SalesAllWorst">{{getSalesAllWorst()}}</td><td ng-model="SalesAllTFBest">{{getSalesAllTFBest()}}</td><td ng-model="SalesAllTFExpected">{{getSalesAllTFExpected()}}</td><td ng-model="SalesAllTFWorst">{{getSalesAllTFWorst()}}</td><td></td></tr>
	<tr><td colspan="3">Factor</td><td ng-model="SalesAllBestFactor">{{getSalesAllBestFactor()}}</td><td ng-model="SalesAllExpectedFactor">{{getSalesAllExpectedFactor()}}</td><td ng-model="SalesAllWorstFactor">{{getSalesAllWorstFactor()}}</td><td></td><td></td><td></td><td></td></tr>	
</table>

<h3>CPA Data (Yes Only)</h3>
<table class="optionscpaonly">
<tr><th>#</th><th>Mod</th><th>Needed</th><th>Best</th><th>Expected</th><th>Worst</th><th>Time Frame <br/>(BEST)</th><th>Time Frame <br/>(EXPECTED)</th><th>Time Frame <br/>(WORST)</th><th>Metric</th></tr>
  <tr ng-repeat="x in newoptionscpayes">
  <td>{{$index + 1}}</td><td>{{x.mod}}</td><td><select disabled ng-model="x.needed" ng-options="entry.k as entry.l for entry in [{k:0, l:'N'}, {k:1,l:'Y'}]">
    </select></td><td><input disabled type="number" ng-model="x.best" step="0.01"/></td><td><input disabled type="number" ng-model="x.expected" step="0.01"/></td><td><input disabled type="number" ng-model="x.worst" step="0.01"/></td><td><input disabled type="number" ng-model="x.timeframeb" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframee" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframew" min="3" max="24" /></td><td>{{x.metric}}</td></tr>
	<tr><td colspan="3">TOTALS</td><td ng-model="CPAYesTotalBest">{{getCPAYesTotalBest()}}</td><td ng-model="CPAYesTotalExpected">{{getCPAYesTotalExpected()}}</td><td ng-model="CPAYesTotalWorst">{{getCPAYesTotalWorst()}}</td><td ng-model="CPAYesTotalTFBest">{{getCPAYesTotalTFBest()}}</td><td ng-model="CPAYesTotalTFExpected">{{getCPAYesTotalTFExpected()}}</td><td ng-model="CPAYesTotalTFWorst">{{getCPAYesTotalTFWorst()}}</td><td></td></tr>
	<tr><td colspan="3">Factor</td><td ng-model="CPAYesTotalBestFactor">{{getCPAYesTotalBestFactor()}}</td><td ng-model="CPAYesTotalExpectedFactor">{{getCPAYesTotalExpectedFactor()}}</td><td ng-model="CPAYesTotalWorstFactor">{{getCPAYesTotalWorstFactor()}}</td><td></td><td></td><td></td><td></td></tr>	
</table>

<h3>CPA Data (ALL)</h3>
<table class="optionscpaall">
<tr><th>#</th><th>Mod</th><th>Needed</th><th>Best</th><th>Expected</th><th>Worst</th><th>Time Frame <br/>(BEST)</th><th>Time Frame <br/>(EXPECTED)</th><th>Time Frame <br/>(WORST)</th><th>Metric</th></tr>
  <tr ng-repeat="x in newoptionscpaall">
  <td>{{$index + 1}}</td><td>{{x.mod}}</td><td><select disabled ng-model="x.needed" ng-options="entry.k as entry.l for entry in [{k:0, l:'N'}, {k:1,l:'Y'}]">
    </select></td><td><input disabled type="number" ng-model="x.best" step="0.01"/></td><td><input disabled type="number" ng-model="x.expected" step="0.01"/></td><td><input disabled type="number" ng-model="x.worst" step="0.01"/></td><td><input disabled type="number" ng-model="x.timeframeb" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframee" min="3" max="24" /></td><td><input disabled type="number" ng-model="x.timeframew" min="3" max="24" /></td><td>{{x.metric}}</td></tr>
	<tr><td colspan="3">TOTALS</td><td ng-model="CPAAllBest">{{getCPAAllBest()}}</td><td ng-model="CPAAllExpected">{{getCPAAllExpected()}}</td><td ng-model="CPAAllWorst">{{getCPAAllWorst()}}</td><td ng-model="CPAAllTFBest">{{getCPAAllTFBest()}}</td><td ng-model="CPAAllTFExpected">{{getCPAAllTFExpected()}}</td><td ng-model="CPAAllTFWorst">{{getCPAAllTFWorst()}}</td><td></td></tr>
	<tr><td colspan="3">Factor</td><td ng-model="CPAAllBestFactor">{{getCPAAllBestFactor()}}</td><td ng-model="CPAAllExpectedFactor">{{getCPAAllExpectedFactor()}}</td><td ng-model="CPAAllWorstFactor">{{getCPAAllWorstFactor()}}</td><td></td><td></td><td></td><td></td></tr>		
</table>

<h3>Projected Numbers</h3>
<div>
<h4>Sales</h4>
<p>{{salesbestjson | json}}</p>
<p>{{salesexpectedjson | json}}</p>
<p>{{salesworstjson | json}}</p>
<p>{{salesalljson | json}}</p>
<h4>Gross Profit</h4>
<p>{{grossprofitbestjson | json}}</p>
<p>{{grossprofitexpectedjson | json}}</p>
<p>{{grossprofitworstjson | json}}</p>
<p>{{grossprofitalljson | json}}</p>
<h4>ROA</h4>
<p>{{roabestjson | json}}</p>
<p>{{roaexpectedjson | json}}</p>
<p>{{roaworstjson | json}}</p>
<p>{{roaalljson | json}}</p>
<h4>CPA</h4>
<p>{{cpabestjson | json}}</p>
<p>{{cpaexpectedjson | json}}</p>
<p>{{cpaworstjson | json}}</p>
<p>{{cpaalljson | json}}</p>
<h4>Budget</h4>
<p>{{budgetbestjson | json}}</p>
<p>{{budgetexpectedjson | json}}</p>
<p>{{budgetworstjson | json}}</p>
<p>{{budgetalljson | json}}</p>
</div>
</div>

<script src="js/angular.min.js" type='text/javascript'></script>
<script src="js/jquery-1.12.4.min.js" type='text/javascript'></script>
<script src="js/bootstrap.min.js" type='text/javascript'></script>
<script type='text/javascript'>
	var app = angular.module('myApp', []);
	app.controller("myCtrl", function($scope) {
		$scope.options = [
			{mod:'Correct Pixel Implementation',metric:'CPA',needed:0,best:-0.05,expected:-0.02,worst:-0.01,timeframeb:12,timeframee:12,timeframew:12},
			{mod:'DPA (Dynamic Product Ads)',metric:'Sales',needed:0,best:0.2,expected:0.1,worst:0.05,timeframeb:12,timeframee:12,timeframew:12},
			{mod:'Naming Convention',metric:'CPA',needed:0,best:-0.05,expected:-0.02,worst:-0.01,timeframeb:12,timeframee:12,timeframew:12},
			{mod:'Daily optimizations',metric:'Sales',needed:0,best:0.1,expected:0.05,worst:0.02,timeframeb:12,timeframee:12,timeframew:12},
			{mod:'Dedicated person running accounts',metric:'Sales',needed:0,best:0.3,expected:0.2,worst:0.1,timeframeb:12,timeframee:12,timeframew:12}
		];
		$scope.orig = angular.copy($scope.options);
		
		$scope.reset = function() {
			$scope.options = angular.copy($scope.orig);
			$scope.newoptions = [];
			$scope.newoptionssalesyes = [];
			$scope.newoptionssalesall = [];
			$scope.newoptionscpayes = [];
			$scope.newoptionscpaall = [];
		};
		
		$scope.cpa = 20;
		$scope.monthlysales = 150;
		$scope.aveordervalue = 65.78;
		$scope.monthlyadspend = 6000;
		$scope.newgross = function() { $scope.currentgross = $scope.cpa * $scope.monthlysales; return $scope.currentgross};
		$scope.newroa = function() { $scope.currentroa = $scope.monthlyadspend / $scope.currentgross; return $scope.currentroa};
		$scope.newgrossprofit = function() { $scope.currentgrossprofit = $scope.monthlysales * $scope.aveordervalue; return $scope.currentgrossprofit};
		
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
		
 		$scope.update = function (){
			$scope.newoptions = [];
			$scope.newoptionssalesyes = [];
			$scope.newoptionssalesall = [];
			$scope.newoptionscpayes = [];
			$scope.newoptionscpaall = [];
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

			
			var salesbestbase = $scope.monthlysales;
			for (i = 0; i < $scope.getSalesYesTotalTFBest(); i++){
				$scope.salesbestjson.push((salesbestbase + (salesbestbase * $scope.getSalesYesTotalBestFactor())));
				salesbestbase = salesbestbase + (salesbestbase * $scope.getSalesYesTotalBestFactor());
			}
			var salesexpectedbase = $scope.monthlysales;
			for (i = 0; i < $scope.getSalesYesTotalTFExpected(); i++){
				$scope.salesexpectedjson.push((salesexpectedbase + (salesexpectedbase * $scope.getSalesYesTotalExpectedFactor())));
				salesexpectedbase = salesexpectedbase + (salesexpectedbase * $scope.getSalesYesTotalExpectedFactor());
			}		
			var salesworstbase = $scope.monthlysales;
			for (i = 0; i < $scope.getSalesYesTotalTFWorst(); i++){
				$scope.salesworstjson.push((salesworstbase + (salesworstbase * $scope.getSalesYesTotalWorstFactor())));
				salesworstbase = salesworstbase + (salesworstbase * $scope.getSalesYesTotalWorstFactor());
			}
			var salesallbase = $scope.monthlysales;
			for (i = 0; i < $scope.getSalesYesTotalTFBest(); i++){
				$scope.salesalljson.push((salesallbase + (salesallbase * $scope.getSalesAllBestFactor())));
				salesallbase = salesallbase + (salesallbase * $scope.getSalesAllBestFactor());
			}		

			
			for (i = 0; i < $scope.getSalesYesTotalTFBest(); i++){
				$scope.grossprofitbestjson.push($scope.salesbestjson[i] * $scope.aveordervalue);
			}			
			for (i = 0; i < $scope.getSalesYesTotalTFExpected(); i++){
				$scope.grossprofitexpectedjson.push($scope.salesexpectedjson[i] * $scope.aveordervalue);
			}
			for (i = 0; i < $scope.getSalesYesTotalTFWorst(); i++){
				$scope.grossprofitworstjson.push($scope.salesworstjson[i] * $scope.aveordervalue);
			}
			for (i = 0; i < $scope.getSalesYesTotalTFBest(); i++){
				$scope.grossprofitalljson.push($scope.salesalljson[i] * $scope.aveordervalue);
			}


			for (i = 0; i < $scope.getSalesYesTotalTFBest(); i++){
				$scope.roabestjson.push($scope.grossprofitbestjson[i] / $scope.monthlyadspend);
			}
			for (i = 0; i < $scope.getSalesYesTotalTFExpected(); i++){
				$scope.roaexpectedjson.push($scope.grossprofitexpectedjson[i] / $scope.monthlyadspend);
			}
			for (i = 0; i < $scope.getSalesYesTotalTFWorst(); i++){
				$scope.roaworstjson.push($scope.grossprofitworstjson[i] / $scope.monthlyadspend);
			}
			for (i = 0; i < $scope.getSalesYesTotalTFBest(); i++){
				$scope.roaalljson.push($scope.grossprofitalljson[i] / $scope.monthlyadspend);
			}

			
			var cpabestbase = $scope.cpa;
			for (i = 0; i < $scope.getCPAYesTotalTFBest(); i++){
				$scope.cpabestjson.push((cpabestbase + (cpabestbase * $scope.getCPAYesTotalBestFactor())));
				cpabestbase = cpabestbase + (cpabestbase * $scope.getCPAYesTotalBestFactor());
			}
			var cpaexpectedbase = $scope.cpa;
			for (i = 0; i < $scope.getCPAYesTotalTFExpected(); i++){
				$scope.cpaexpectedjson.push((cpaexpectedbase + (cpaexpectedbase * $scope.getCPAYesTotalExpectedFactor())));
				cpaexpectedbase = cpaexpectedbase + (cpaexpectedbase * $scope.getCPAYesTotalExpectedFactor());
			}		
			var cpaworstbase = $scope.cpa;
			for (i = 0; i < $scope.getCPAYesTotalTFWorst(); i++){
				$scope.cpaworstjson.push((cpaworstbase + (cpaworstbase * $scope.getCPAYesTotalWorstFactor())));
				cpaworstbase = cpaworstbase + (cpaworstbase * $scope.getCPAYesTotalWorstFactor());
			}
			var cpaallbase = $scope.cpa;
			for (i = 0; i < $scope.getCPAYesTotalTFBest(); i++){
				$scope.cpaalljson.push((cpaallbase + (cpaallbase * $scope.getCPAAllBestFactor())));
				cpaallbase = cpaallbase + (cpaallbase * $scope.getCPAAllBestFactor());
			}			

			
			for (i = 0; i < $scope.getSalesYesTotalTFBest(); i++){
				$scope.budgetbestjson.push($scope.salesbestjson[i] * $scope.cpabestjson[i]);
			}		
			for (i = 0; i < $scope.getSalesYesTotalTFExpected(); i++){
				$scope.budgetexpectedjson.push($scope.salesexpectedjson[i] * $scope.cpaexpectedjson[i]);
			}	
			for (i = 0; i < $scope.getSalesYesTotalTFWorst(); i++){
				$scope.budgetworstjson.push($scope.salesworstjson[i] * $scope.cpaworstjson[i]);
			}		
			for (i = 0; i < $scope.getSalesYesTotalTFBest(); i++){
				$scope.budgetalljson.push($scope.salesalljson[i] * $scope.cpaalljson[i]);
			}			
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