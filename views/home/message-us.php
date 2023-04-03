<section id="contuct-us" class="message-us">
    <div class="us-details">
        <div class="title">Leave a message</div>
        <p class="desc">Fill up the form,<br> our team will back to you in 24 hourse</p>
        
        <div style="width: 100%"><iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q=Institute%20of%20Science%20and%20Technology+(Hashpatal)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">measure acres/hectares on map</a></iframe></div>
    </div>
    <form id="message-us-box" class="message-box">
        <div class="input-div">
            <div class="level">Subject</div>
            <input name="subject" type="text" placeholder="Subject">
        </div>
        <div class="input-div">
            <div class="level">Message</div>
            <textarea name="message" type="text" placeholder="Message"></textarea>
        </div>
        <button id="message-us-button" class="button-1">Send</button>
    </form>
</section>

<script>
    let form = document.querySelector('#message-us-box');
    if (form !== null) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            let subject = form.elements["subject"].value;
            let message = form.elements["message"].value;
            openMail("<?php echo ADMINMAIL ?>", subject, message);
        });
    }
</script>