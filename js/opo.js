
if(document.getElementById('toggle')){

    var toggle = document.getElementById('toggle');
    var add = document.getElementById('add');
    var counter = document.getElementById('counter');
    var rate = document.getElementById('rate');
    var cheat = document.getElementById('cheat'); // for demo only
    var loop;

    var logger = {
        counts: false,
        start: 0,
        end: 0,
        time: 0,
        total: 0,

        timer: function() {    

            if(logger.counts === true) {
                logger.counts = false;
                clearInterval(loop);
                logger.total = logger.total + logger.time;
                toggle.innerText = 'start';
                toggle.classList.remove('pause')

            } else {
                logger.counts = true;
                toggle.innerText = 'pause';
                toggle.classList.add('pause')
                logger.start = Date.now();

                clearInterval(loop);
                loop = setInterval(function(){
                    logger.update();
                    
                }, 500);   
            }
        },
        update: function(){
            logger.end = Date.now();
            logger.time = Math.floor((logger.end - logger.start) / 1000);
            var totalseconds = logger.total + logger.time;
            // make prettier
            if(totalseconds < 60) {
                counter.innerHTML = totalseconds + " secs";
            } else {
                counter.innerHTML = Math.floor(totalseconds / 60) + " mins";
            }


            //
            
        },
        form: function() {
            var worked = ((logger.total / 60) / 60); //convert to hours 
            var dollar = (worked * rate.value);

            dollar = Math.floor(dollar);

            if (dollar > 0) {
                amount.value = dollar;
            } else {
                amount.value = 'Not chargable time'
            }

            
        },
        cheat: function() {
            console.log(logger.total);
            logger.total = logger.total + 1800;
            console.log(logger.total);
        }
    }
    toggle.addEventListener('click', logger.timer, false);
    add.addEventListener('click', logger.form, false);
    cheat.addEventListener('click', logger.cheat, false);
}



// pdf bill - creates dummy bill as the templating for FPDF is kinda mind-numbing
if(document.getElementById('generate')){

    
    var gen = document.getElementById('generate');

    function genBill(x) {

        var req = new XMLHttpRequest();

            req.onreadystatechange = function() {
            if (req.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
               if (req.status == 200) {
                   document.getElementById("confirm").innerHTML = 'Not a real bill, dummy PDF dropped in app root';
                   document.getElementById("confirm").classList.add('reveal');
               }
               else if (req.status == 400) {
                  alert('There was an error 400');
               }
               else {
                   alert('something else other than 200 was returned');
               }
            }
        };

        req.open('POST', './inc/gen_bill.php', true);
        req.send(x);

        console.log(req);
    }


gen.addEventListener('click', genBill, false);


}
