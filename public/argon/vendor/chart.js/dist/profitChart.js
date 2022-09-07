var max = 0;
var chartData = {};
var myLineChart;
var options = {};
function respondCanvas() {
     var ctx = document.getElementById("chart-sales");
     //Call a function to redraw other content (texts, images etc)
     myLineChart = new Chart(ctx, {
          type: 'line',
          scaleOverride: true,
          scaleStepWidth: Math.ceil(max),
          scaleStartValue: 0,
          data: chartData,
          options: chartOptions,
     });
}

var GetChartData = function (curr) {
     if (myLineChart != null) {
          myLineChart.destroy();
     }
     $.ajax({
          url: '/monthly-chart-data',
          method: 'GET',
          dataType: 'json',
          data: { curr: curr },
          success: function (response) {
               chartData = {
                    labels: response.months, // The response got from the ajax request containing all month names in the database
                    datasets: [{
                         label: "Profit",
                         lineTension: 0.3,
                         backgroundColor: "transparent",
                         borderColor: "rgba(2,117,216,1)",
                         pointRadius: 5,
                         pointBackgroundColor: "rgba(2,117,216,1)",
                         pointBorderColor: "rgba(255,255,255,0.8)",
                         pointHoverRadius: 5,
                         pointHoverBackgroundColor: "rgba(2,117,216,1)",
                         pointHitRadius: 20,
                         pointBorderWidth: 2,
                         data: response.month_total_profit // The response got from the ajax request containing data for the completed jobs in the corresponding months
                    }],
               }
               chartOptions = {
                    responsive: true,
                    plugins: {
                         title: {
                              display: true,
                              text: 'Min and Max Settings'
                         }
                    },
                    scales: {
                         y: {
                              min: 0,
                              max: response.max,
                         }
                    }
               };

               max = Math.max.apply(Math, response.month_total_profit);

               respondCanvas();
          }
     });
};

$(document).ready(function () {
     // $(window).resize(respondCanvas);
     $("#curr").change(function () {
          var curr = $('#curr option:selected').val();
          GetChartData(curr);
     });

});