<?php if($user): ?>
<h3>Hello <?=$user->firstname; 
?></h3> <img src = "<?=$user->imagepath;?>" alt="Smiley face" width="42" height="42">
<?php else:?>

<h3>Please sign up or login, thanks.</h3>

<?php endif; ?>

<h2>Additional features</h2>
<ol>
<li>Photos upload was implemented</li>
<li>Two users cannot log in with the same email. Logic to check the database was added.</li>
<li>Default photo has been implemented for users who do not upload a photo</li>
<li>Client side sorting of Users that are being followed and those that are not being followed </li>
<li>Display of images of users near user names</li>
<li>Time of last update of the site. </li>
<li>Validation to only allow "gif", "jpeg", "jpg" or "png" files to be uploaded as profile images</li>
<li>Sign up information fields are ALL required at the client side.</li>
<li>Valid email addresses are needed for sign up</li>
<li>Users are sent to the login page after sign up</li>
</ol>  
