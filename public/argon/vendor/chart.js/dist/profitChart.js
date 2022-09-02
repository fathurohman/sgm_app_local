(function ($) {
     var curr = $('#curr option:selected').val();
     var charts = {
          init: function () {
               // -- Set new default font family and font color to mimic Bootstrap's default styling
               // Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
               // Chart.defaults.global.defaultFontColor = '#292b2c';

               this.ajaxGetPostMonthlyData();

          },

          ajaxGetPostMonthlyData: function () {
               var urlPath = '/monthly-chart-data';
               var request = $.ajax({
                    method: 'GET',
                    url: urlPath,
                    data: { currency: curr },
               });

               request.done(function (response) {
                    charts.createCompletedJobsChart(response);
               });
          },

          /**
           * Created the Completed Jobs Chart
           */
          createCompletedJobsChart: function (response) {

               var ctx = document.getElementById("chart-sales");
               var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                         labels: response.months, // The response got from the ajax request containing all month names in the database
                         datasets: [{
                              label: "Profit IDR",
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
                         }
                         ],
                    },
                    options: {
                         legend: {
                              display: true
                         }
                    }
               });
          }
     };

     charts.init();

})(jQuery);