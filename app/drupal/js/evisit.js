function ev_settings(options) {
    $(function () {
        $("#dialog").dialog({
            autoOpen: false,
            show: {
                effect: "blind",
                duration: 1000
            },
            hide: {
                effect: "explode",
                duration: 1000
            }
        });
    });
    $.getScript("http://api.visitwrapper.dev/js/vendor/jquery.calendario.js");
    $.getScript("http://api.visitwrapper.dev/js/vendor/modernizr.custom.63321.js");
    $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "http://api.visitwrapper.dev/css/" + options.theme + ".css"
    }).appendTo("head");
    $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css"
    }).appendTo("head");
    $(document).ready(function () {
        $('#evcal').append("<div id='ev-container'></div><div class='ev-loader'>Loading</div><div id='ev-dialog' title='Basic dialog'></div>");
        $('.ev-loader').fadeIn('slow');

        $.ajax({
            url: "http://api.visitwrapper.dev/ev_visit/endpoint/post",
            type: 'post',
            crossDomain: true,
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify({settings: options, method: 'calendar'}),
            traditional: true,
            success: function (data) {
                $('.ev-loader').fadeOut("slow");
                // load css
                $("#ev-container").append("<div class='custom-calendar-wrap custom-calendar-full'>"
                    + "<div class='custom-header clearfix'>"
                    + "<h3 class='custom-month-year'>"
                    + "<span id='custom-month' class='custom-month'></span>"
                    + "<span id='custom-year' class='custom-year'></span>"
                    + "<nav>"
                    + "<span id='custom-prev' class='custom-prev'></span>"
                    + "<span id='custom-next' class='custom-next'></span>"
                    + "<span id='custom-current' class='custom-current' title='Got to current date'></span>"
                    + "</nav>"
                    + "</h3>"
                    + "</div><div id='calendar' class='fc-calendar-container'></div>"
                    + "</div>").show('slow');

                dialog = $("#ev-dialog").dialog({
                    autoOpen: false,
                    height: 600,
                    width: 600,
                    modal: true,
                    show: {
                        effect: "blind",
                        duration: 1000
                    },
                    hide: {
                        effect: "blind",
                        duration: 1000
                    },
                    close: function () {

                    }
                });


                $(function () {
                    var cal = $('#calendar').calendario({
                            onDayClick: function ($el, $contentEl, dateProperties) {
                                for (var key in dateProperties) {
                                    console.log(key + ' = ' + dateProperties[key]);
                                }
                                $date = dateProperties['weekdayname'] + ' ' + dateProperties['day']+ ' '
                                    + dateProperties['monthname'] + ' '
                                    + dateProperties['year'];
                                $('.ev-loader').fadeIn('slow');
                                $.ajax({
                                    url: "http://api.visitwrapper.dev/ev_visit/endpoint/post",
                                    type: 'post',
                                    dataType: 'json',
                                    contentType: "application/json; charset=utf-8",
                                    data: JSON.stringify({settings: options, method: 'hour', day: dateProperties}),
                                    traditional: true,
                                    success: function (data) {
                                        $time_schedule = $.renderhour(options, data.scheduler);
                                        $('.ev-loader').fadeOut('slow');
                                        $("#ev-dialog").html($time_schedule).dialog("open");
                                        $('#ev-dialog').dialog('option', 'title', $date);
                                    },
                                    failure: function (errMsg) {
                                        $('.ev-loader').fadeOut('slow');
                                    }
                                });
                            },
                            caldata: data.calendar_day
                        }),
                        $month = $('#custom-month').html(cal.getMonthName()),
                        $year = $('#custom-year').html(cal.getYear());

                    $('#custom-next').on('click', function () {
                        cal.gotoNextMonth(updateMonthYear);
                    });
                    $('#custom-prev').on('click', function () {
                        cal.gotoPreviousMonth(updateMonthYear);
                    });
                    $('#custom-current').on('click', function () {
                        cal.gotoNow(updateMonthYear);
                    });

                    function updateMonthYear() {
                        $month.html(cal.getMonthName());
                        $year.html(cal.getYear());
                    }

                    /*                   cal.setData({
                     '03-09-2016': '<a href="#">testing</a>',
                     '09-08-2016': '<a href="44">testing</a>',
                     '03-12-2013': '<a href="#">testing</a>'
                     });*/
                    // goes to a specific month/year
                    //  cal.goto( 3, 2013, updateMonthYear );
                });
                $('.ev-loader').fadeOut('slow');
            },
            failure: function (errMsg) {
            }
        });
    });
}

$.renderhour = function (options, element) {
    var arr = [];
    $.each(element, function (index, value) {
        arr.push('<div id=' + index + '  class=' + ' timecell ' + value.status + '>' + value.begin + ' - ' + value.end + '</div>');
    });
    return arr.join("");
};
