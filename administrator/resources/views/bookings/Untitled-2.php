<?php
// Assuming you have already established a database connection

// Input parameters
$checkInDate = '2023-07-15';
$checkOutDate = '2023-07-20';
$numberOfRooms = 2;

// Query to check availability
$query = "SELECT COUNT(*) AS available_rooms
          FROM bookings
          WHERE check_out_date > '$checkInDate'
            AND check_in_date < '$checkOutDate'
          HAVING available_rooms >= $numberOfRooms";

// Execute the query
$result = mysqli_query($connection, $query);

// Check if the query was successful
if ($result) {
    // Fetch the result
    $row = mysqli_fetch_assoc($result);
    $availableRooms = $row['available_rooms'];

    // Check availability
    if ($availableRooms >= $numberOfRooms) {
        echo "Rooms are available for booking.";
    } else {
        echo "Sorry, no rooms are available for the selected dates.";
    }
} else {
    echo "Error executing the query: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>


select `r`.`hotel_id` as `hotel_id`, `r`.`id` as `room_id`, `rr`.`total_room_book`, `r`.`room_count`, `b`.`checkin`, `r`.`room_count` - `rr`.`total_room_book` as `room_left` from `bookings` as `b` inner join `reserved_rooms` as `rr` on `rr`.`booking_id` = `b`.`id` inner join `rooms` as `r` on `rr`.`room_id` = `r`.`id` where `bookings`.`checkout` > 2023-07-15 and `bookings`.`checkin` < 2023-07-16



1 2 3 4 5 6 7
