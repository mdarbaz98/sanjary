INR("[data-countdown]").each(function(){var n=INR(this),s=INR(this).data("countdown");n.countdown(s,function(n){INR(this).html(n.strftime('<div class="coming-box">%D <span>Days</span></div> <div class="coming-box">%H <span>Hours</span></div> <div class="coming-box">%M <span>Minutes</span></div> <div class="coming-box">%S <span>Seconds</span></div> '))})});