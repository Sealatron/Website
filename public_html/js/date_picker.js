    var todays_date = new Date();
    var year_range = 30; //Number of years to display
    var month_names = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    
    var date_picker = {};
    date_picker.day = document.getElementById("day_picker");
    date_picker.month = document.getElementById("month_picker");
    date_picker.year = document.getElementById("year_picker");

    function update_year_picker(year, range)
    {
        for(i = -range; i <= range; i++)
        {
            var option = document.createElement("option");
            option.text = year - i;
            console.log(option.text + "; " + i + "; " + year);
            date_picker.year.add(option,date_picker.year[i+range]);
        }
    }

    function update_month_picker()
    {
        for(i = 0; i < 12; i++)
        {
            var option = document.createElement("option");
            option.text = month_names[i];
            date_picker.month.add(option,date_picker.month[i]);
        }
    }

    function update_day_picker(month_length)
    {
        var current = date_picker.day.selectedIndex;
        var length = date_picker.day.length;
        for(i = length - 1; i >= 0; i--)
        {
            date_picker.day.remove(i);
        }

        for(i = 0; i<month_length; i++)
        {
            var option = document.createElement("option");
            option.text = i+1;
            date_picker.day.add(option,date_picker.day[i]);
        }
        date_picker.day.selectedIndex = (current < month_length)? current: month_length-1;
    }

    var update_date_picker = function()
    {
        var month_length = 0;

        switch(date_picker.month.value)
        {
            case "February":
            {
                month_length = (date_picker.year.value % 4) ? 28: 29;
            }break;
            case "April":
            case "June":
            case "September":
            case "November":
            {
                month_length = 30;
            }break;
            default:
            {
                month_length = 31;
            }break;
        }

        update_day_picker(month_length);
    };
/*    update_year_picker(todays_date.getFullYear(), year_range);
    update_month_picker();

    date_picker.year.selectedIndex = 0;
    date_picker.month.selectedIndex = todays_date.getMonth();

    update_date_picker();
    date_picker.day.selectedIndex = todays_date.getDate()-1;

    month.addEventListener("change",update_date_picker); 
    year.addEventListener("change",update_date_picker); */
