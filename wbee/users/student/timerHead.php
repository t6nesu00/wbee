<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="margin: 0 0 0 10px;">
      <li><div id="countdowntimer" style="display: block; padding: 10px 10px; font-weight: bold;"></div></li>
    </ol>
</nav>

<script type="text/javascript">
  setInterval(function() {
    timer();
  }, 1000);
  function timer() 
	{
		 var xmlhttp = new XMLHttpRequest();
		 xmlhttp.onreadystatechange = function() {
			 if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				 if(xmlhttp.responseText == "00:00:01") {
           window.location = "result.php";
         }
         document.getElementById("countdowntimer").innerHTML = xmlhttp.responseText;
			 }
		 };
		 xmlhttp.open("GET", "../../ajax/load_timer.php", true);
		 xmlhttp.send(null);
	}
</script>