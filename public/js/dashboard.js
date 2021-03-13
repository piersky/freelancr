/* globals Chart:false, feather:false */

(function () {
    'use strict'

    feather.replace()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/admin/graph',
        method: 'POST',
        complete: function(resp){
            var labels = [];
            var dataset = [];

            var dates = $.parseJSON(resp.responseText)
            dates.reverse;

            var currentTime = new Date();
            var j = 0;
            for (var i=0; i<30; i++) {
                var last_month = new Date();
                last_month.setDate(currentTime.getDate() - 30 + i);
                var last_dd = String(last_month.getDate()).padStart(2, '0');
                var last_mm = String(last_month.getMonth() + 1).padStart(2, '0'); //January is 0!
                var last_yyyy = last_month.getFullYear();

                var month = dates[j].month.length==1?"0"+dates[j].month:dates[j].month;
                var day = dates[j].day.length==1?"0"+dates[j].day:dates[j].day;

                labels.push(last_dd);

                if (last_yyyy == dates[j].year && last_mm == month && last_dd == day ) {
                    dataset.push(parseInt(dates[j].hours));
                    j++;
                } else {
                    dataset.push(0);
                }
            }

            // Graphs
            var ctx = document.getElementById('activityChart')

            // eslint-disable-next-line no-unused-vars
            var activityChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        data: dataset,
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        borderWidth: 1,
                        pointBackgroundColor: '#007bff'
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        display: false
                    }
                }
            })
        }
    })
})()
