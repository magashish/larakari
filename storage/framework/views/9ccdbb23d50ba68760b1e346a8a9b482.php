<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service Date</title>
</head>
<body>

    <p>Dear Admin,</p>

    <p>We are writing to inform you about the updates to service dates:</p>

    <p><strong>Arrival Date:</strong> <?php echo e($arrival_date); ?></p>
    <p><strong>Arrival Time:</strong> <?php echo e($arrival_time); ?></p>
    <p><strong>Checkout Date:</strong> <?php echo e($departure_date); ?></p>
    <p><strong>Checkout Time:</strong> <?php echo e($departure_time); ?></p>
    <p><strong>Room Code:</strong> <?php echo e($room_code); ?></p>
    <p><strong>Notes:</strong> <?php echo e($notes); ?></p>

    <p>Please review the updated details and <a href="<?php echo e($url); ?>">click here</a> to make any necessary edits.</p>

    <p>Thank you!</p>

    <p>Best regards,<br><?php echo e($user); ?></p>
</body>
</html>
<?php /**PATH /home/1241039.cloudwaysapps.com/yuhjztazqa/public_html/resources/views/emails/edit_service_date.blade.php ENDPATH**/ ?>