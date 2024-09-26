<?php
include('includes/header.php');
include('includes/navbar.php');
include('config.php');
?>
<?php
// Get meeting ID or some unique identifier from the URL (e.g., meeting ID passed as a query parameter)
// Assuming meeting_id is passed in the URL
// $meeting_id = $_GET['meeting_id'];

// $fetch_meeting_query = "SELECT join_url FROM meetings WHERE meeting_id = '$meeting_id'";
// $meeting_result = mysqli_query($connection, $fetch_meeting_query);

// if ($meeting_result && mysqli_num_rows($meeting_result) > 0) {
//     $meeting_data = mysqli_fetch_assoc($meeting_result);
//     $join_url = $meeting_data['join_url'];

//     header("Location: $join_url");
//     exit;
// } else {
//     echo "Meeting not found or invalid meeting ID.";
// }
?>


<!-- Header Section -->
<section class="pricing-plans">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading text-center">
          <h6>Our Meeting</h6>
          <h4>Welcome to <em>Our Meeting</em>..!</h4>
        </div>
      </div>

      <!-- Meeting Section -->
      <section class="meeting-container">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
              <div class="meeting-frame shadow-lg">
                <iframe id="meetingIframe" class="w-100 h-100" src="https://zoom.us" title="Meeting"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
</section>

<style>
  /* body {
  font-family: 'Arial', sans-serif;
  background-color: #f0f0f0;
} */

  .meeting-container {
    /* padding: 40px 0; */
    background: #fff;
    border-radius: 10px;
    margin-top: 30px;
  }

  .meeting-frame {
    position: relative;
    width: 100%;
    padding-top: 56.25%;
    /* 16:9 Aspect Ratio */
    border: 2px solid #007bff;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease-in-out;
  }

  .meeting-frame:hover {
    border-color: #28a745;
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  }

  #meetingIframe {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
  }

  /* footer {
  margin-top: 40px;
  background-color: #333;
} */

  footer p {
    margin: 0;
    font-size: 14px;
  }

  @media (max-width: 768px) {
    .meeting-container {
      padding: 20px;
    }

    .meeting-frame {
      padding-top: 75%;
      /* Adjust aspect ratio for mobile */
    }
  }
</style>


<?php
include('includes/footer.php');
?>