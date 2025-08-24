<p id="live-clock"><span>Time...</span></p>
<h1 id="live-date"><span>Date...</span></h1>


<script>
    function updateClocks() {
        var now = new Date();

        var hours = now.getHours() % 12 || 12;
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        var ampm = now.getHours() < 12 ? 'AM' : 'PM';

        document.getElementById('live-clock').innerHTML = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    }

    setInterval(updateClocks, 1000);
</script>

<script>
    function updateClock() {
        var timestamp = Date.now();

        var now = new Date(timestamp);

        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var month = monthNames[now.getMonth()];
        var day = now.getDate();
        var year = now.getFullYear();

        document.getElementById('live-date').innerHTML = month + ' ' + day + ', ' + year;
    }

    setInterval(updateClock, 1000);
</script>



