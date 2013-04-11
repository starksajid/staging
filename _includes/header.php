<?php
   
    if(isset($_SESSION['login_user'])){
      ?><script type="text/javascript">window.location.href = 'https://www.social123.com/help.php';</script>
    <?php }
    ?>
<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
        
        <!-- This makes the small nav for smaller screens -->
          <a class="btn btn-primary btn-dropnav" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>	
          
          	
          <a class="brand" href="http://www.social123.com">
          
          <img src="/newgraphics/logosocial1234.png" alt="http://www.social123.com"></a>
		  
          <div class="nav-collapse collapse">
            <ul class="nav pull-right" >
           
                       
         
              <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="navstyline">Solutions<span class="caret"></span> </a>
              <ul class="dropdown-menu">
               <li><a href="/salesprospecting/salesleads.php" >Sales Prospecting</a></li>
                <li><a href="/salesleads/leadgeneration.php" >Lead Generation</a></li>
                <li><a href="/socialcrm/socialcrmdata.php" >Social CRM</a></li>
                <li><a href="/salesleads/salesintelligence.php" >Sales Intelligence</a></li>
                <li><a href="/socialapi/socialapi.php" >Developer APIs</a></li>
              </ul>
                 <li><a href="/salesleads/pricing.php">Pricing</a></li>
                 <li><a href="/salesleads/whysocial123.php">Why Social123</a></li>
                
                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Company<span class="caret"></span> </a>
              <ul class="dropdown-menu">
               <li><a href="/salesleads/about.php" >About Social123</a></li>
                <li><a href="/salesleads/management.php">Leadership</a></li>
                <li><a href="/salesleads/board.php">Board of Directors</a></li>
                <li><a href="/salesleads/investors.php">Investors</a></li>
                <li><a href="/salesleads/careers.php">Careers</a></li>
                <li><a href="/salesleads/contactus.php">Contact Us</a></li>
				<li><a href="/salesleads/webinar.php">Webinar & Events</a></li>
                <li><a href="https://www.social123.com/salestipsguide/company-news/">Company News</a></li>
              </ul>
                
                
               
                  <li><a href="/salesleads/signup.php">Sign Up</a></li>
                  <li><a href="https://www.social123.com/login/">Login</a></li>
                  </ul>
		  </div>
        </div>
      </div>
    </div>
