<?php require_once("inc/global.php"); ?>
<html>
  <head>
    <?php require_once("inc/head.php"); ?>
    <title>Apiary Hives</title>
  </head>
  <body class="sidebar-collapse">
    <!--Navbar-->
    <?php require_once("inc/navbarindex.php"); ?>


    <img id="index-img" src="img/group-pose.png" alt="ApiaryHives team" class="home-page-img"/>

  <!--Features Section-->
    <element id="features-section" class="home-page">
    <header class="header-text-3 header-text-sections"><div class="header-title-3">Features</div>
      <div class="features-box">
        <div class="features-item f1">
            <div class="feature-header">Messaging</div>
        </div>
        <div class="features-item f2">
            <div class="feature-header">Community Oriented Interface</div>
        </div>  
        <div class="features-item f3">
            <div class="feature-header">Workplace Report System</div>
        </div>
        <div class="features-item f4">
            <img src="img/feature-messaging.png" class="features-img" alt="ApiaryHives messaging feature">
        </div>
        <div class="features-item f5">
            <img src="img/feature-community-orientated-interface.png" class="features-img" alt="ApiaryHives community oriented Interface">
        </div>
        <div class="features-item f6">
            <img src="img/feature-report-system.png" class="features-img" alt="ApiaryHives report system">
        </div>  
        <div class="features-item f7">
            <div class="features-text">Communicate directly with coworkers through the chat box feature on the left side of the feed. Connect with one or more peers, utilizing group chats with the cability of sending images, pdfs and other file types.</div>
        </div>
        <div class="features-item f8">
            <div class="features-text">Working as a team has never been made easier with the sleek and modern design of the main dashboard. Having the capability of seeing current posts, company-wide announcements, and departmental reminders allows for a simple way to stay on task for the company's current initiatives.</div>
        </div>
        <div class="features-item f9">
            <div class="features-text">Safety is a top priority in any group setting, so finding a quick way to report any interpersonal workplace challenges is vital. Fill out a small form providing details of the incident that will instantly be sent to the admin accounts and HR.</div>
        </div>
      </div>
    </header>
    </element>
    <br>
    <br>
    <br>

    <!--Gallery Section-->
    <element id="gallery-section" class="home-page">
    <div class="container py-5">
      <header class="header-text-3 header-text-sections">
        <div class="header-title-3">Gallery</div>
        <p class="font-italic mb-0 small gallery-subtitle">Communicate with ease...</p>
      </header>

      <div class="row py-5">
        <div class="col-lg-4">
          <figure class="rounded p-3 bg-white shadow-sm">
            <img src="img/dashboard-feed.png" alt="dashboard feed" class="w-100 card-img-top">
            <figcaption class="p-4 card-img-bottom">
              <h2 class="h5 font-weight-bold mb-2 font-italic">Post Feed</h2>
              <p class="mb-0 text-small text-muted font-italic">Navigate company posts and view what your coworkers have shared.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4">
          <figure class="rounded p-3 bg-white shadow-sm">
            <img src="img/msg-app-img.png" alt="messaging app" class="w-100 card-img-top">
            <figcaption class="p-4 card-img-bottom">
              <h2 class="h5 font-weight-bold mb-2 font-italic">Messaging Application</h2>
              <p class="mb-0 text-small text-muted font-italic">Utilize chat messages to communicate directly with coworkers.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4">
          <figure class="rounded p-3 bg-white shadow-sm">
            <img src="img/quick-anc-img.png" alt="announcement viewing page" class="w-100 card-img-top">
            <figcaption class="p-4 card-img-bottom">
              <h2 class="h5 font-weight-bold mb-2 font-italic">Quick Announcements</h2>
              <p class="mb-0 text-small text-muted font-italic">Includes a constant feed of quick blurbs to gain employees attention, both within their department and company-wide.</p>
            </figcaption>
          </figure>
        </div>
      </div>

      <div class="row py-5">
        <div class="col-lg-4">
          <figure class="rounded p-3 bg-white shadow-sm">
            <img src="img/search-bar-img.png" alt="search bar" class="w-100 card-img-top">
            <figcaption class="p-4 card-img-bottom">
              <h2 class="h5 font-weight-bold mb-2 font-italic">Search Bar</h2>
              <p class="mb-0 text-small text-muted font-italic">Quickly find posts and users via keywords inside top right search bar.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4">
          <figure class="rounded p-3 bg-white shadow-sm">
            <img src="img/report-img.png" alt="report page" class="w-100 card-img-top">
            <figcaption class="p-4 card-img-bottom">
              <h2 class="h5 font-weight-bold mb-2 font-italic">Report System</h2>
              <p class="mb-0 text-small text-muted font-italic">Report any workplace incidents with ease, delivered directly to the HR department.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4">
          <figure class="rounded p-3 bg-white shadow-sm">
            <img src="img/it-report-img.png" alt="IT ticket page" class="w-100 card-img-top">
            <figcaption class="p-4 card-img-bottom">
              <h2 class="h5 font-weight-bold mb-2 font-italic">Technology Tickets</h2>
              <p class="mb-0 text-small text-muted font-italic">Solve any technology related problems with a simple form connected to your IT department.</p>
            </figcaption>
          </figure>
        </div>
      </div>
    </div>
    </element>

  <!--About Section-->
    <element id="about-section" class="home-page">
    <header class="header-text-3 header-text-sections">
      <div class="header-title-3">About Us</div>
      <img src="img/about-us.png" class="about-us-img-web" alt="ApiaryHives team about us">
      <img src="img/mobile-about-img.png" class="about-us-img-mobile" alt="ApiaryHives team about us">
    </header>
    </element>

    <!--Footer-->
    <?php require_once("inc/footer.php"); ?>
  </body>
</html>
