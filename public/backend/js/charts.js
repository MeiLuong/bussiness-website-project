/*  ---------------------------------------------------
    Template Name: FocusPoint
    Author: Mei
---------------------------------------------------------  */

'use strict';

(function ($) {

    $(document).ready(function (e) {

        $(function () {
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd"
            });
            $("#datepicker2").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });

        $('#btn-dashboard-filter').click(function () {
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();
            alert(from_date);
            alert(to_date);

            $.ajax({
                url: "{{ url('/admin/filter-by-date') }}",
                method: "POST",
                dataType: "JSON",
                data: {from_date: from_date, to_date: to_date, _token: _token},
                success: function (data) {
                    chart.setData(data);
                }
            });
        });


        const ctx = document.getElementById('myChart');

        var data = [2,4,5,6,12,4];
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Date', 'Date', 'Date', 'Green', 'Date', 'Date'],
                datasets: [{
                    label: '# of Votes',
                    data: data,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


    });

})(jQuery);
