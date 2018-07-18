<?php if ($data['actionNotification']) $this->component('shared/action-notification', $data['actionNotification']); ?>
<h1><?php echo $data['title']; ?></h1>
 <form action="" method="post" id="mspb-form" name="mspb-form">
    <input type="text" name="yourName" value="" placeholder="Your Name" id="yourName">
    <textarea name="comment" id="comment" rows="3" placeholder="Say something"></textarea>
    <button type="submit" id="example-form-submit" name="example-form-submit">Let's go</button>
 </form>