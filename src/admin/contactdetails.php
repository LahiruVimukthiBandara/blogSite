<?php
require '../includes/db.php';
require '../includes/PHPMailer.php';
require '../includes/SMTP.php';
require '../includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Email configuration
$mail = new PHPMailer(true);

try {
    // Configure SMTP
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'citytimes.blog@gmail.com';
    $mail->Password = 'wgcqnubsagkmbdyf';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Set the From and Reply-To addresses
    $mail->setFrom('citytimes.blog@gmail.com', 'City Times');
    $mail->addReplyTo('citytimes.blog@gmail.com', 'City Times');

    // getting data from table
    $select_sql = "SELECT name, email, message FROM contactus ORDER BY id DESC";
    $result = $db->query($select_sql);

    $messages = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    // count messages
    $sql = "SELECT * FROM contactus";
    $result = $db->query($sql);

    $messsages = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messsages[] = $row;
        }
    }
    $messagecount = count($messsages);

    $db->close();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if reply form is submitted
        if (isset($_POST['reply'])) {
            $messageId = $_POST['message_id'];
            $replyMessage = $_POST['reply_message'];

            // Set the recipient's email address
            $emailTo = $messages[$messageId]['email'];

            // Set the email subject and body
            $subject = 'Reply to your message';
            $body = "Dear " . $messages[$messageId]['name'] . ",\n\n";
            $body .= "Thank you for your message. Here is the reply:\n\n";
            $body .= $replyMessage;
            $body .= "\n\nBest regards,\nYour Company";

            // Clear any previous recipients, if present
            $mail->clearAddresses();

            // Add the recipient
            $mail->addAddress($emailTo);

            // Set the email subject and body
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Send the email
            $mail->send();

            // redrect to same page
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }
} catch (Exception $e) {
    echo 'Email sending error: ' . $mail->ErrorInfo;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>citytimes</title>
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="stylesheet" href="../dist/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/scrollreveal"></script>

    <style>
        .name-column,
        .email-column {
            width: 20%;
        }

        .message-column {
            width: 60%;
        }

        .buttonhover {
            transition: 0.3s ease-in-out;
        }

        .buttonhover:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-[#000000]">

    <div class="py-[4%] px-[10%] md:px-[2%] md:py-[1%] lg:px-[10%] lg:py-[4%]">

        <h1 class="text-3xl text-white text-center font-semaibold uppercase mt-4 mb-5">Messages from users</h1>

        <div class=" mt-6 py-5 text-start flex justify-center">
            <h2 class="text-lg lg:text-2xl font-bold text-white capitalize"><span class="text-yellow-400"><?php echo $messagecount; ?> </span>messages </h2>
        </div>

        <?php if (!empty($messages)) { ?>
            <table class="min-w-full bg-[#0a0a0a] border-none outline-none rounded-lg w-[500px]">
                <!-- ... -->
                <tbody>
                    <?php foreach ($messages as $index => $message) { ?>
                        <tr>
                            <td class="py-4 px-6 border-b text-white text-lg capitalize text-center name-column"><?php echo $message['name']; ?></td>
                            <td class="py-4 px-6 border-b text-white text-lg text-center email-column"><?php echo $message['email']; ?></td>
                            <td class="py-4 px-6 border-b text-white text-lg text-center message-column"><?php echo $message['message']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="py-4 px-6 border-b text-white text-lg ">
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="message_id" value="<?php echo $index; ?>">
                                    <textarea name="reply_message" rows="3" class="py-2 px-3 border bg-[#292929] border-none outline-none text-gray-700 rounded-lg w-full h-[100px]" placeholder="Write a reply..." required></textarea>
                                    <button type="submit" name="reply" class="buttonhover mt-2 w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl text-white font-semibold py-2 px-4 rounded-lg">Reply</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="text-white text-xl font-semibold text-center mt-10">No messages yet!</p>
        <?php } ?>
    </div>
</body>

</html>