<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$alert = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP config
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rendonrendon17@gmail.com'; 
        $mail->Password = 'plxk nwqp ptcf jxvg';      
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email setup
        $mail->setFrom('rendonrendon17@gmail.com', 'Website Contact'); // trusted sender
        $mail->addReplyTo($email); // so you can reply directly to user
        $mail->addAddress('rendonrendon17@gmail.com'); // your inbox

        $mail->isHTML(true);
        $mail->Subject = 'New Request Message';
        $mail->Body = '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; background-color: #f9f9f9; border-radius: 8px; border: 1px solid #e0e0e0;">
            <h2 style="color: #4a4a4a; border-bottom: 2px solid #667eea; padding-bottom: 10px;">📩 Contact Message</h2>
            <table style="width: 100%; margin-top: 20px;">
                <tr>
                    <td style="padding: 10px 0; font-weight: bold; color: #333;">📧 Email:</td>
                    <td style="padding: 10px 0; color: #555;">' . htmlspecialchars($email) . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0; font-weight: bold; color: #333;">📱 Contact:</td>
                    <td style="padding: 10px 0; color: #555;">' . htmlspecialchars($contact) . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0; font-weight: bold; color: #333;">📍 Address:</td>
                    <td style="padding: 10px 0; color: #555;">' . htmlspecialchars($address) . '</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top: 20px;">
                        <div style="font-weight: bold; color: #333; margin-bottom: 5px;">💬 Message:</div>
                        <div style="color: #555; line-height: 1.6;">' . nl2br(htmlspecialchars($message)) . '</div>
                    </td>
                </tr>
            </table>
            <p style="font-size: 12px; color: #999; margin-top: 30px; border-top: 1px solid #eee; padding-top: 10px;">
                Sent via Contact Form • ' . date('F j, Y \a\t g:i A') . '
            </p>
        </div>
        ';

        $mail->send();

        $alert = '
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Message Sent!",
                text: "Thank you, your message has been sent successfully.",
                confirmButtonColor: "#3085d6"
            });
        });
        </script>';
    } catch (Exception $e) {
        $alert = '
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "Message could not be sent. ' . addslashes($mail->ErrorInfo) . '",
                confirmButtonColor: "#d33"
            });
        });
        </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="shortcut icon" href="image/don3.PNG">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            box-sizing: border-box;
            font-family: "Segoe UI", sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(to right, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .contact-container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }

        .contact-container img {
            display: block;
            margin: 0 auto 20px;
            /* Center the image with margin */
            max-width: 100px;
            /* Set a max width for the logo */
            height: auto;
        }

        .contact-container h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }

        .contact-container h6 {
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }
        .contact-container p {
            font-size: 10px;
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            transition: 0.3s ease;
        }

        form input:focus,
        form textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2);
        }

        form button {
            width: 100%;
            padding: 12px;
            background-color: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover {
            background-color: #5a67d8;
        }
    </style>
</head>

<body>

    <div class="contact-container">
        <!-- Image logo -->
        <img src="image/don3.png" alt="Company Logo" />
        <h6>Rendon T. Torente</h6>
        <h6>For Inquiries, Message Me Here!</h6>

        <p> If you have any questions or need help with your project, feel free to reach out! I’m happy to discuss your
            ideas and provide the support you need. Let’s work together to make your vision a reality!</p>
        <h2>Message</h2>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Your Email" required />
            <input type="number" name="contact" placeholder="Contact Number" required />
            <input type="text" name="address" placeholder="Your Address" required />
            <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>

    <script>
        // Add your SweetAlert2 code or other JS functionality here if needed
    </script>

    <?= $alert ?>
</body>

</html>