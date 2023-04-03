<section class="page-end">
    <div class="title">
        Pioneering medical excellence at Hashpatal
    </div>
    <p>Not just better healthcare, but a better healthcare experience. Passionate About Medicine. Compassionate About People. Serving all people through exemplary health care, education, research, and community outreach.</p>
    <div class="buttonss">
        <a href="/doctors"><button class="button-1 bxx">Book Appointment Now</button></a>
        <button id="call-button" class="button-1 byy"> <i class="fas fa-phone"></i> +8801533523233</button>
    </div>
    <a href="/about-us"><button class="button-1">Learn More</button></a>
</section>

<script>
    document.getElementById("call-button").addEventListener("click", () => {
        navigator.clipboard.writeText("+8801533523233").then(() => {
            alert("Number copied!");
        })
    })
</script>