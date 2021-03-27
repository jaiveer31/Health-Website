// Delete this to stop animation
setInterval(function () {
    $(".perspective").toggleClass("active");
}, 3000);

function alert() {

    var msg = "do you like to inform the nearest hospital for the medical assistance and Ambulanec?";
    functionConfirm(msg, myYes, myNo, cancel);
}

function functionConfirm(msg, myYes, myNo, cancel) {
    var confirmBox = $("#confirm");
    confirmBox.find(".message").text(msg);
    confirmBox.find(".yes,.no,.cancel").unbind().click(function () {
        confirmBox.hide();
    });
    confirmBox.find(".yes").click(myYes);
    confirmBox.find(".no").click(myNo);
    confirmBox.find(".no").click(cancel);
    confirmBox.show();
}