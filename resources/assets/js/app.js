
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('vue');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


var open = false;
var position='collapsed';


$('.showActivities').on('click', function () {
    var that = $(this);
    open = !open;

    if (position=='collapsed') {
        $(this).animate({height:'300px'});
        position='expanded';
    } else {
        $(this).animate({height:'65px'});
        position='collapsed';
    }
    
    if(open) {
        $.get("activities",
            {
                '_token': '{{csrf_token()}}',
                'schedule_detail_id': $(this).attr('id')
            }
        ).done(function (data) {

            if (data === []) {
                that.find('ul.activity_list').append("<li style='list-style-type: none;' class='newElement'> You don't have any activities yet this week. Start running or zombies will eat your brains! </li>");
            } else {
                that.find('ul.activity_list').append("<li style='list-style-type: none;'class='newElement'><p>This is how much you've run this week!</p></li>");
                $.each(data, function (i, value) {
                    that.find('ul.activity_list').append("<li style='list-style-type: none; display: flex; justify-content: space-around;' class='newElement'><p class='activity_date'>" + value[0] + "</p> <p class='activity_distance'>" + value[1] + " km done!</p></li>");
                });
            }
        })
    }
    else{
        $(this).find('ul.activity_list').children().remove();
    }
});

/*Graph1*/

var url = "activities/chart";
var userData = [];
var kmRun = [];
$(document).ready(function(){
    $.get(url,
        {
            '_token': $('input[name*="_token"]').val()
        }
    ).done(function(response) {
       console.log(response[0]);
        //console.log(response['km_per_week']);
      // $.each(response ,function (data) {
            userData.push(response[0]);
            kmRun.push(response[1]);
       // });
        var Chart = require('chart.js');
        var context = document.querySelector('#myGraph').getContext('2d');
        var myChart = new Chart(context, {
            type: 'bar',
            data: {
                labels: ["KM run"],
                datasets: [{
                    label: 'How much you ran',
                    data: kmRun,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                },{
                    label: 'How much you should run',
                    data:userData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    })
});

/*Graph2*/

var url1 = "dashboard/chart";
var zombies = [];
var humans = [];
$(document).ready(function(){
    $.get(url1,
        {
            '_token': $('input[name*="_token"]').val()
        }
    ).done(function(response) {
        //console.log(response);
        //console.log(response['km_per_week']);
        // $.each(response ,function (data) {
        humans.push(response[0]);
        zombies.push(response[1]);
        // });
        var Chart = require('chart.js');
        var context = document.querySelector('#GraphZombievsHuman').getContext('2d');
        var myChart = new Chart(context, {
            type: 'doughnut',
            data: {
                labels: ["Humans", "Zombies"],
                datasets: [
                    {
                        label: "Population",
                        backgroundColor: ["#FF5D0D","#35a67c","#c45850"],
                        data: [
                            humans,
                            zombies
                        ]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: ''
                }
            }


        });
    })
});

/*Graph3*/
var url2 = "dashboard/chartOne";
var zombieskm = [];
var humanskm = [];
$(document).ready(function(){
    $.get(url2,
        {
            '_token': $('input[name*="_token"]').val()
        }
    ).done(function(response) {
        //console.log(response);
        //console.log(response['km_per_week']);
        // $.each(response ,function (data) {
        humanskm.push(response[0]);
        zombieskm.push(response[1]);
        // });
        var Chart = require('chart.js');
        var context = document.querySelector('#graphZombieHumanKm').getContext('2d');
        var myChart = new Chart(context, {
            type: 'doughnut',
            data: {
                labels: ["Humans KM", "Zombies KM"],
                datasets: [
                    {
                        label: "Population",
                        backgroundColor: ["#FF5D0D","#35a67c","#c45850"],
                        data: [
                            humanskm,
                            zombieskm
                        ]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: ''
                }
            }


        });
    })
});