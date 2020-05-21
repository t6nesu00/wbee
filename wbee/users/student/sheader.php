
<!-- font awesome link -->
<script src="https://kit.fontawesome.com/900414f59a.js" crossorigin="anonymous"></script>



<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="students.php">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="students.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Exam</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
    </ul>
    <ul class="navbar-nav">
    <li class="nav-item">
            <span> </span>
        </li>
        <li class="nav-item">
            <a class="dropdown-item" href="../../logout.php">Logout</a>
        </li>
    </ul>
  </div>
  </nav>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li><div id="countdowntimer" style="display: block; padding: 10px 10px;"></div></li>
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
