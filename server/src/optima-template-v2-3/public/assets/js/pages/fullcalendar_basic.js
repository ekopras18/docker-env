/* ------------------------------------------------------------------------------
 *
 *  # Fullcalendar basic options
 *
 *  Demo JS code for extra_fullcalendar_views.html and extra_fullcalendar_styling.html pages
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var FullCalendarBasic = function() {


    //
    // Setup module components
    //

    // Basic calendar
    var _componentFullCalendarBasic = function() {
        if (typeof FullCalendar == 'undefined') {
            console.warn('Warning - Fullcalendar files are not loaded.');
            return;
        }

        // Add demo events
        // ------------------------------

        // Default events
        // var events = [
        //     {
        //         title: 'All Day Event',
        //         start: '2022-12-01',
        //         color: '#0C6839'
        //     },
        //     {
        //         title: 'Long Event',
        //         start: '2022-12-07',
        //         end: '2022-12-10',
        //         color: '#0C6839'
        //     },
        //     {
        //         id: 999,
        //         title: 'Repeating Event',
        //         start: '2022-12-09T16:00:00',
        //         color: '#0C6839'
        //     },
        //     {
        //         id: 999,
        //         title: 'Repeating Event',
        //         start: '2022-12-16T16:00:00',
        //         color: '#0C6839'
        //     },
        //     {
        //         title: 'Conference',
        //         start: '2022-12-11',
        //         end: '2022-12-13',
        //         color: '#0C6839'
        //     },
        //     {
        //         title: 'Meeting',
        //         start: '2022-12-12T10:30:00',
        //         end: '2022-12-12T12:30:00',
        //         color: '#0C6839'
        //     },
        //     {
        //         title: 'Lunch',
        //         start: '2022-12-12T12:00:00',
        //         color: '#0C6839'
        //     },
        //     {
        //         title: 'Meeting',
        //         start: '2022-12-12T14:30:00',
        //         color: '#0C6839'
        //     },
        //     {
        //         title: 'Happy Hour',
        //         start: '2022-12-12T17:30:00',
        //         color: '#0C6839'
        //     },
        //     {
        //         title: 'Dinner',
        //         start: '2022-12-12T20:00:00',
        //         color: '#0C6839'
        //     },
        //     {
        //         title: 'Birthday Party',
        //         start: '2022-12-13T07:00:00',
        //         color: '#0C6839'
        //     },
        //     {
        //         title: 'Click for Google',
        //         url: 'http://google.com/',
        //         start: '2022-12-28',
        //         color: '#0C6839'
        //     }
        // ];

        var events = [];


        // Initialization
        // ------------------------------

        //
        // Basic view
        //

        // Define element
        var calendarBasicViewElement = document.querySelector('.fullcalendar-basic');

        // Initialize
        if(calendarBasicViewElement) {
            var calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
                plugins: [ 'dayGrid', 'interaction' ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                // editable: true,
                events: events,
                eventLimit: true
            }).render();
        }

    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentFullCalendarBasic();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    FullCalendarBasic.init();
});
