// Document ready
$(function(){

    var cinemaHall1 = {
        row: [5, 7, 9, 9, 9, 9, 9]
    };

    var cinemaHallMap = '';
// перебираем все ряды
    for (var i = 0; i < cinemaHall1.row.length; i++) {
        // запомнили номер ряда
        var rowNumber = i + 1;
        // сколько мест в этом ряду
        var numberOfSeats = cinemaHall1.row[i];
        var cinemaHallRow = '';
        // перебираем места в ряду
        for (var j = 0; j < numberOfSeats; j++) {
            // запомнили номер текущего места
            var seatNumber = j + 1;
            cinemaHallRow += '<div class="seat" data-row="' +
                rowNumber + '" data-seat="' +
                seatNumber + '">' + seatNumber + '</div>';
        }
        cinemaHallMap += cinemaHallRow + '<div class="passageBetween">&nbsp;</div>';
    }

//заполняем в html зал номер 1
    $('.zal1').html(cinemaHallMap);
// тут по клику определяем что место выкуплено
    $('.seat').on('click', function(e) {
        // если первый раз кликнули билет выкупили,
        // если повторно значит вернули билет
        $(e.currentTarget).toggleClass('bay');
        //показываем сколько билетов выкуплено
        showBaySeat();
    });

    function showBaySeat() {
        result = '';
        var seats = [];
        //ищем все места купленные и показываем список выкупленных мест
        $.each($('.seat.bay'), function (key, item) {
            seats[seats.length] = {row: $(item).data().row, seat: $(item).data().seat};
            result += '<div  style="color: black" class="ticket">Ряд: ' +
                $(item).data().row + ' Место:' +
                $(item).data().seat + '</div>';
        });

        $('.result').html(result);
        window.seats = seats;
    }

    window.order = {};
    
   $('.time').on('click',function () {
       var time = $(this).data("time");
       order.time = time;
       $('.time_cinema').html(time);
       var hall = $(this).parent().parent().find('.hall-name').data("hall");
       order.hall = hall;
   })
});

$('.order_button').on('click',function () {
    var data = {};
    data.movie_name = $('#movie_title').html();
    data.time = order.time;
    data.hall = order.hall;
    data.seats = seats;
    $.ajax({
        url: "/order_new",
        method: "POST",
        data: data,
        success: function (response) {
            console.log(response);
            // window.location = '/user_page';
        }
    });
});