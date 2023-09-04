<?php 
include_once('..\..\required/server.php');
$reservationData = getReservationData($_POST['id']);
$user = getUserById($reservationData['uid']);
if ($reservationData['status'] == 0) {
    $status ='Pending'; 
} else {
    $status ='Approved'; 
}
?>

<div class="modal fade" id="reservationModel" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reservation Details:</h5>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item</th>
                            <th scope="col">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Full Name</td>
                            <td><?=getUserFullName($reservationData['uid'])?></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Landmark Name</td>
                            <td><?=getlandmarkNameByID($reservationData['landmarkID'])?></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Reservation Code</td>
                            <td><?=$reservationData['reservCode']?></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Payment Method</td>
                            <td>
                                <?php 
                                if ($reservationData['paymentMethods'] == 0) {
                                    echo 'Cash (On Arrival)';
                                } else {
                                    echo 'Credit Card';
                                }
                                ?>
                            </td>
                        </tr> 
                        <tr>
                            <th scope="row">4</th>
                            <td>Phone Number</td>
                            <td><?=$user['phone']?></td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Email</td>
                            <td><?=$user['email']?></td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>Reservation Start Date</td>
                            <td><?=$reservationData['reservIFrom']?></td>
                        </tr>
                        <tr>
                            <th scope="row">7</th>
                            <td>Reservation End Date</td>
                            <td><?=$reservationData['reservITo']?></td>
                        </tr>
                        <tr>
                            <th scope="row">8</th>
                            <td>Total Price</td>
                            <td><?=$reservationData['reservIPrice']?></td>
                        </tr>
                        <tr>
                            <th scope="row">9</th>
                            <td>Action Date</td>
                            <td><?=$reservationData['createdAt']?></td>
                        </tr>
                        <tr>
                            <th scope="row">10</th>
                            <td>Status</td>
                            <td><?=$status?></td>
                        </tr>
                        <?php 
                        if ($reservationData['paymentMethods'] == 1) {
                            ?> 
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Card Details</th>
                                    <th scope="col">Value</th>
                                </tr>
                            </thead>
                            <tr>
                                <th scope="row">1</th>
                                <td>Credit Card Number</td>
                                <td><?=$reservationData['cardID']?></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Expiration Date</td>
                                <td><?=$reservationData['expiration']?></td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>CVV</td>
                                <td><?=$reservationData['cvv']?></td>
                            </tr> 
                            <?php
                        } 
                        ?> 
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="accept(<?=$reservationData['id']?>)" class="btn btn-outline-primary">Accept</button>
            </div>
        </div>
    </div>
</div>
