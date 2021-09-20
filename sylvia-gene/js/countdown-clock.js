function countdown_clock(year, month, day, hour, minute, format)
         {
         //I chose a div as the container for the timer, but
         //it can be an input tag inside a form, or anything
         //who's displayed content can be changed through
         //client-side scripting.
         html_code = '<span id="countdown"></span>';
         
         document.write(html_code);
         
         countdown(year, month, day, hour, minute, format);                
         }
         
function countdown(year, month, day, hour, minute, format)
         {
         Today = new Date();
         Todays_Year = Today.getFullYear() - 2000;
         Todays_Month = Today.getMonth() + 1;                  
         
         //Convert both today's date and the target date into miliseconds.                           
         Todays_Date = (new Date(Todays_Year+2000, Todays_Month, Today.getDate(), 0, 0, 0)).getTime();                                 
         
		 //Todays_Date = (new Date(2016, 7, 31, 00, 00, 00)).getTime();                                 
		 
         /*alert (
			"year="+Todays_Year +  
			"month="+Todays_Month +  
			"date="+Today.getDate() +  
			"hour="+Today.getHours() +  
			"minute="+Today.getMinutes() +  
			"second="+Today.getSeconds());*/
			
		Target_Date = (new Date(year+2000, month, day, hour, minute, 00)).getTime();                  
		
		/*alert (
			"year="+year +  
			"month="+month +  
			"date="+day +  
			"hour="+hour +  
			"minute="+minute +  
			"second=00");*/
		 
		 /*alert (
			"Todays_Date="+Todays_Date +
			"Target_Date="+Target_Date);*/
		 
         //Find their difference, and convert that into seconds.                  
         Time_Left = Math.round((Target_Date - Todays_Date) / 1000);
         
		 /*alert (Time_Left);*/
		 
         if(Time_Left < 0)
            Time_Left = 0;
         
         switch(format)
               {
               case 0:
                    //The simplest way to display the time left.
                    document.getElementById('countdown').innerHTML = Time_Left + ' seconds';
                    break;
               case 1:
                    //More datailed.
                    days = Math.floor(Time_Left / (60 * 60 * 24));
                    //Time_Left %= (60 * 60 * 24);
                    //hours = Math.floor(Time_Left / (60 * 60));
                    //Time_Left %= (60 * 60);
                    //minutes = Math.floor(Time_Left / 60);
                    //Time_Left %= 60;
                    //seconds = Time_Left;
                    
                    //there is a bug... below is the code to fix
					if((month-Todays_Month)>0) days++;
					
                    dps = 's';// hps = 's'; mps = 's'; sps = 's';
                    //ps is short for plural suffix.
                    if(days == 1) dps ='';
                   //if(hours == 1) hps ='';
                    //if(minutes == 1) mps ='';
                    //if(seconds == 1) sps ='';
                    
					
					document.getElementById('countdown').innerHTML = days + " day" + dps + " 'til THE BIG DAY";
                    
                    //document.getElementById('countdown').innerHTML = days + ' day' + dps + ' ';
                    //document.getElementById('countdown').innerHTML += hours + ' hour' + hps + ' ';
                    //document.getElementById('countdown').innerHTML += minutes + ' minute' + mps + ' and ';
                    //document.getElementById('countdown').innerHTML += seconds + ' second' + sps;
                    //document.getElementById('countdown').innerHTML += ' until the wedding';
                    break;
               default: 
                    document.getElementById('countdown').innerHTML = Time_Left + ' seconds';
               }
               
         //Recursive call, keeps the clock ticking.
         setTimeout('countdown(' + year + ',' + month + ',' + day + ',' + hour + ',' + minute + ',' + format + ');', 3600000); // 1000 = 1s
         }