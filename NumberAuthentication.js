window.onload=function () {
  render();
};
function render() {
    window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}
function phoneAuth() {
    //get the number
    var number='+88'+document.getElementById('buyer_number').value;
    //phone number authentication function of firebase
    //it takes two parameter first one is number,,,second one is recaptcha
    firebase.auth().signInWithPhoneNumber(number,window.recaptchaVerifier).then(function (confirmationResult) {
        //s is in lowercase
        window.confirmationResult=confirmationResult;
        coderesult=confirmationResult;
        console.log(coderesult);
        alert("Message Sent");
        document.getElementById("comment-section-d").style.display = "inline";
    }).catch(function (error) {
        alert(error.message);
    });
}
function codeverify() {

    var code=document.getElementById('verificationCode').value;
    coderesult.confirm(code).then(function (result) {

        var buyer_name=document.getElementById('buyer_name').value;
        var buyer_number=document.getElementById('buyer_number').value;
        var buyer_bid_price=document.getElementById('buyer_bid_price').value;
        var product_id=document.getElementById('product_id').value;

        jQuery.ajax({
            url: 'insertComment.php',
            type: 'POST',
            data: {
                "buyer_name": buyer_name,
                "buyer_number": buyer_number,
                "buyer_bid_price": buyer_bid_price,
                "product_id": product_id
            },
            dataType: "json",
            success: function(result) {
            }
        });
        window.location.href = 'shop-detail.php?product_id='+product_id;
    }).catch(function (error) {
        alert(error.message);
    });
}