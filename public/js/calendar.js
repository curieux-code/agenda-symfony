window.onload=function(){

    var att = [
        {
          highlight: {
            backgroundColor: '#ddd',     // Red background
            //borderColor: '#ff6666',
            //borderWidth: '2px',
            //borderStyle: 'solid',
            //borderRadius: '5px',
          },
          //contentStyle: {
            //color: 'white',                 // White text
          //},
          //bar: {
            //backgroundColor: '#28bea3', // Red dot
          //},
          dates: [
           {
              start: new Date(2018, 2, 4),  // Jan 1st
           	  end: new Date(2018, 2, 20),    // - Jan 4th
            }
          ],
        }
    ];

    new Vue({
        el: '#app',
        data: {
            // Data used by the date picker
            mode: 'single',
            selectedDate: null,
            att,
        },
        methods:{
            day(){
                console.log(arguments);
            }
        }
    })

}