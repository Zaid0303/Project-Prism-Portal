<?php
include('includes/header.php');
include('includes/navbar.php');
include('config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);



    // Client credentials
    $client_id = 'gkIRqtw6TXKRYF3rnNZL0A';
    $client_secret = 'yCN3goV7VdE8Gpo6CU2r5Go8x354SL4O';
    $account_id = '43GllG4MQR-d9WY54DZRIQ';

    // Prepare data for the access token request
    $token_url = "https://zoom.us/oauth/token?grant_type=account_credentials&account_id=" . $account_id;

    // Base64 encode client ID and client secret
    $auth_header = base64_encode($client_id . ':' . $client_secret);

    // Initialize cURL for token request
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $token_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic $auth_header",
            "Content-Type: application/json"
        ),
    ));

    // Execute token request
    $response = curl_exec($ch);
    $err = curl_error($ch);

    if ($err) {
        echo json_encode(array('error' => "cURL Error #:" . $err));
        exit;
    }

    // Decode the response to get the access token
    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];
    } else {
        echo json_encode(array('error' => 'Failed to retrieve access token.'));
        exit;
    }

    // Close cURL after token request
    curl_close($ch);

    // Meeting details from the form
    $data = array(
        'topic' => $_POST['topic'],
        'start_time' => date("Y-m-d\TH:i:s\Z", strtotime($_POST['start_time'])), // UTC time format
        'duration' => $_POST['duration'],  // in minutes
        'type' => 2,   // Scheduled meeting
        'password' => $_POST['password']
    );

    $request_url = "https://api.zoom.us/v2/users/sajidasharmeen@aptechnorth.edu.pk/meetings";

    // Headers for the meeting creation request
    $headers = array(
        "Authorization: Bearer " . $access_token,
        "Content-Type: application/json",
        "Accept: application/json"
    );

    // Initialize cURL for meeting creation
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $request_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => $headers,
    ));

    // Execute the meeting creation request
    $response = curl_exec($ch);
    $err = curl_error($ch);

    // Close cURL after meeting creation request
    curl_close($ch);

    if ($err) {
        echo json_encode(array('error' => "cURL Error #:" . $err));
    } else {
        $response_data = json_decode($response, true);
        echo json_encode($response_data);
    }

    exit;




    // YAHAN P DATABASE M URL JAYEGA



}
?>

<!-- Include Bootstrap for styling -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


<section class="pricing-plans">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h6>Zoom Meetings</h6>
                    <h4>Create a <em>Zoom Meeting</em> are here</h4>
                </div>
            </div>


            <form id="zoomForm">
                <div class="form-group">
                    <label for="topic">Meeting Topic:</label>
                    <input type="text" class="form-control" id="topic" name="topic" required>
                </div>
                <div class="form-group">
                    <label for="start_time">Start Time:</label>
                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
                </div>
                <div class="form-group">
                    <label for="duration">Duration (minutes):</label>
                    <input type="number" class="form-control" id="duration" name="duration" required>
                </div>
                <div class="form-group">
                    <label for="password">Meeting Password:</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Create Meeting</button>
            </form>
            <div id="response" class="mt-4"></div>
        </div>
    </div>
</section>

<!-- jQuery and Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#zoomForm').on('submit', function (e) {
            e.preventDefault();

            var formData = {
                topic: $('#topic').val(),
                start_time: $('#start_time').val(),
                duration: $('#duration').val(),
                password: $('#password').val()
            };

            $.ajax({
                url: '', // Since the form and PHP are in the same file, leave the URL empty
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.join_url) {
                        $('#response').html(
                            '<div class="alert alert-success">Meeting created successfully!<br>' +
                            'Join URL: <a href="' + response.join_url + '" target="_blank">' + response.join_url + '</a></div>'
                        );
                    } else {
                        $('#response').html('<div class="alert alert-danger">Error: ' + (response.message || 'Unknown error occurred') + '</div>');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#response').html('<div class="alert alert-danger">Failed to create meeting: ' + errorThrown + '</div>');
                }
            });
        });
    });
</script>
<?php
include('includes/footer.php');
?>